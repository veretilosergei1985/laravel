<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Post extends Model {

    protected $table = 'posts';
    //public $timestamps = false;
    protected $fillable = array('title', 'content', 'publish', 'user_id');
    
//    public function setUpdatedAtAttribute($value)
//    {        
//    }
//    
//    public function setCreatedAtAttribute($value)
//    {        
//    }
}
