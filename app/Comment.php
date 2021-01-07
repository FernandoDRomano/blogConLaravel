<?php

namespace App;

use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'body', 'user_id', 'post_id', 'parent_comment_id'
    ];

    /* 
        RELACIÓN CON LOS OTROS MODELOS
    */

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function childs(){
        return $this->hasMany(Comment::class, 'parent_comment_id');
    }

    public function parent(){
        return $this->belongsTo(Comment::class, 'parent_comment_id');
    }

    /* 
        METODOS
    */

    public function isFather(){
        return !$this->parent_comment_id ? true : false;
    }

}
