<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\View\View;
use \Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;


class CommentController extends Controller {

	public function __construct()
	{
            $this->middleware('auth');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
        
        public function add(Request $request, $id = '')
        {
            if (empty($id)) {
                $model = new \App\Models\Post();
            }

            if ($request->isMethod('post')) {
                $this->validate($request, [
                    'comment' => 'required',
                ]);

                $comment = \Illuminate\Support\Facades\Request::input('comment');                                
               
                \App\Models\Comment::create(array(
                    'post_id' => $id,
                    'comment' => $comment,
                    'user_id' => (int)Auth::user()->id,
                    'created_at' => date('Y-m-d H:i:s'),
                ));
                
                //echo "23423"; exit;
                return redirect()->to('post/view/' . $id);
            }
        }
        
        public function delete(Request $request, $id = '') {
            $model = \App\Models\Post::find($id);
            if (!is_null($model)) {
                $model->delete();
                return redirect()->to('/');
            }
            return response()->view('errors.404', array(), 404);
        }

        public function view(Request $request, $id = '') {
            $model = \App\Models\Post::find($id);
            if (!is_null($model)) {
                return view('post.view', ['model' => $model]);
            }
            return response()->view('errors.404', array(), 404);
        }
        
        public function addform(Request $request, $id = '') {
            $model = \App\Models\Comment::find($id);
            $returnHTML = view('comment.form')->with('comment', $model)->render();
            return json_encode(array('success' => true, 'html' => $returnHTML));
        }
        
        public function answer(Request $request, $id = '') {
            $model = \App\Models\Comment::find($id);
            if (!is_null($model)) {
                $this->validate($request, [
                    'comment' => 'required',
                ]);

                $comment = \Illuminate\Support\Facades\Request::input('comment');
                $postId = \Illuminate\Support\Facades\Request::input('postId');
//                echo $id; exit;
                $comment = \App\Models\Comment::create(array(
                    'post_id' => $postId,
                    'parent_id' => $id,
                    'comment' => $comment,
                    'user_id' => (int)Auth::user()->id,
                    'created_at' => date('Y-m-d H:i:s'),
                ));
                $returnHTML = view('comment.comment')->with('comment', $comment)->with('postId', $postId)->render();
                return json_encode(array('success' => true, 'html' => $returnHTML));
            }
        }

}
