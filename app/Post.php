<?php

namespace App;

use App\Tag;
use App\User;
use App\Image;
use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'extract', 'body', 'iframe', 'published_at', 'approved', 'url', 'user_id', 'category_id'
    ];

    /* PARA QUE CARBON RECONOZCA LA FECHA */
    protected $dates = ['published_at'];

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

    public function scopeApproveds($query){
        return $query->whereNotNull('published_at')
                     ->where('published_at', '<=' , Carbon::now())
                     ->where('approved', true); 
    }

    public function isVisibled(){
        return (bool) $this->published_at && $this->published_at <= today() && $this->approved;
    }

    public function createPost($request){
        $this->fill($request->all());
        $this->generateUrl();
        $this->user_id = auth()->user()->id;
        $this->save();
    }

    public function deletePost()
    {
        $this->images->each->deleteImage();
        $this->tags()->detach();
        $this->delete();
    }
    
    public function updatePostAndSyncTags($request){
        $this->update($request->all());
        $this->syncTags($request->tags);
    }
    
    public function syncTags($tags){
        $this->tags()->sync($tags);
    }
    
    public function generateUrl(){
        $url = Str::slug($this->title);

        $post = Post::where('url', 'LIKE', $url . '%')->exists();

        if($post){
            $url .= '-' . uniqid();
        }

        $this->url = $url;
    }

    public function typeViewImageOrCarousel($view = null){
        
        if($this->images->count() === 1){

            return 'public.post._image';

        }else if($this->images->count() > 1 ){

            if($view === "blog"){

                if ($this->images->count() < 4) {
                    return 'public.post._image';
                }else{
                    return 'public.post._grid';
                }

            }else{
                return 'public.post._carousel';
            }

        }else{

            return null;
        
        }

    }

    public function countImagesForGrid(){
        return $this->images->count() - 4;
    }
}
