<?php

namespace App;

use App\Tag;
use App\User;
use App\Image;
use App\Category;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'extract', 'body', 'iframe', 'published_at', 'approved', 'url', 'user_id', 'category_id'
    ];

    /* 
        RELACIÓN CON LOS MODELOS
    */

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }

    /* 
        METODOS
    */

    public function getRouteKeyName()
    {
        return 'url';
    }

}
