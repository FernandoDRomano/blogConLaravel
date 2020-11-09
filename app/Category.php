<?php

namespace App;

use App\Post;
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
}
