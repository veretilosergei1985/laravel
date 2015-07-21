<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\View\View;
use \Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;


class PostController extends Controller {

	public function __construct()
	{
            $this->middleware('auth');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
        
        public function create(Request $request, $id = '')
        {
            //echo Auth::user()->id; exit;
            if (empty($id)) {
                $model = new \App\Models\Post();
            } else {
                $model = \App\Models\Post::find($id);                
                if (is_null($model)) {
                    return response()->view('errors.404', array(), 404);
                }
            }

            if ($request->isMethod('post')) {
                $this->validate($request, [
                    'title' => 'required|max:255',
                    'content' => 'required',
                ]);
                $title = \Illuminate\Support\Facades\Request::input('title');
                $content = \Illuminate\Support\Facades\Request::input('content');
                $publish = \Illuminate\Support\Facades\Request::input('publish') === null ? 0 : 1;
                                
                if (empty($id)) {                
                    \App\Models\Post::create(array(
                        'title' => $title,
                        'content' => $content,
                        'publish' => $publish,
                        'user_id' => (int)Auth::user()->id,
                        'created_at' => date('Y-m-d H:i:s'),
                    ));
                } else {
                    $model->fill(
                        [
                            'title' => $title,
                            'content' => $content,
                            'publish' => $publish,
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]
                    );
                    $model->save();
                }
                //echo "23423"; exit;
                return redirect()->to('/');
            }
            return  view('post.create')->with(compact('model'));
        }
        
        public function index() {
            $posts = \App\Models\Post::where('publish', 1)->paginate(3);
            return view('post.index', ['posts' => $posts]);
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
                //$comments = \App\Models\Comment::where('post_id', $id)->get();
                
                
                $comment = new \App\Models\Comment();
                $tree = $comment->getTree($id);                
                //echo "<pre>"; print_r($tree); exit;
                
                return view('post.view', ['model' => $model, 'comments' => $tree]);
            }
            return response()->view('errors.404', array(), 404);
        }

}
