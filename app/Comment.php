<?php

namespace App;

use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'body', 'user_id', 'post_id', 'comment_id'
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
        return $this->hasMany(Comment::class);
    }
}
