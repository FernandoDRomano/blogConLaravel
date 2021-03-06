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
        MUTADORES Y ACCESORES
    */

    //PARA QUE AL GUARDAR EL NOMBRE MODIFIQUE LA URL AUTOMATICAMENTE
    public function setNameAttribute($value){
        $this->attributes['name'] = $value;
        $this->attributes['url'] = $this->generateUrl();
    }


    /* 
        METODOS
    */

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function generateUrl(){
        return Str::slug($this->name);
    }

}
