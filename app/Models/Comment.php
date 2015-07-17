<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

    protected $table = 'comment';
    protected $fillable = array('post_id', 'parent_id', 'user_id', 'comment');

}
