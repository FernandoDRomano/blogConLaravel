<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'imagen', 'post_id'
    ];

    /* 
        RELACIÓN CON LOS OTROS MODELOS
    */

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
