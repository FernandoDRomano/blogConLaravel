<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $fillable = [
        'url', 'post_id'
    ];

    /* 
        RELACIÓN CON LOS OTROS MODELOS
    */

    public function post(){
        return $this->belongsTo(Post::class);
    }

    /* 
        OTROS METODOS
    */

    public function deleteImage(){
        Storage::delete($this->url);
        $this->delete();
    }
}
