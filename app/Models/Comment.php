<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

    protected $table = 'comments';
    protected $fillable = array('post_id', 'parent_id', 'user_id', 'comment');
    public $out = '';


    public $childs;
    protected function buildTree(&$data, $rootID = 0) {
  
        //$tree = array();
        $this->out .= '<ul>';
        foreach ($data as $id => $node) {
            $userModel = \App\User::findById($node->user_id);
            $name = isset($userModel['name']) ? $userModel['name'] : 'unkown';
            if ($node->parent_id == $rootID) {
                unset($data[$id]);
                $this->out .= '<li class="comment-block" comment_id="'.$node->id.'" post_id="'.$node->post_id.'">
                                <div>'
                                . $node->comment .
                                '</div>
                                <div>
                                    <i>Created : '. $node->created_at . '</i>
                                </div>
                                <div>
                                    <i>By : ' . $name . '</i>
                                </div>
                              </li>';
                $node->childs = $this->buildTree($data, $node->id);
                //$tree[] = $node;
            }
        }
        $this->out .= '</ul>';
        return $this->out;
    }
    
    public function getTree($postId)
    {
        $data = self::where('post_id', $postId)->get();
        return $this->buildTree($data);
    } 

}
