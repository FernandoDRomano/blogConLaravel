<?php

namespace App;

use App\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'url'
    ];

    /* 
        RELACIONES CON OTROS MODELOS
    */

    public function posts(){
        return $this->hasMany(Post::class);
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
