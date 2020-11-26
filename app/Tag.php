<?php

namespace App;

use App\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name', 'url'
    ];

    /* 
        RELACIÓN CON OTROS MODELOS
    */

    public function posts(){
        return $this->belongsToMany(Post::class);
    }

    /* 
        METODOS
    */

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function generateUrl(){
        $this->url = Str::slug($this->name);
    }
}
