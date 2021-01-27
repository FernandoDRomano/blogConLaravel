<?php

namespace App;

use App\Tag;
use App\User;
use App\Image;
use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;
use PhpParser\Node\Expr\Cast\String_;

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

    public function comments(){
        return $this->hasMany(Comment::class)->whereNull('parent_comment_id');
    }

    /* 
        MUTADORES Y ACCESORES
    */

    //PARA QUE AL GUARDAR EL NOMBRE MODIFIQUE LA URL AUTOMATICAMENTE
    public function setTitleAttribute($value){
        $this->attributes['title'] = $value;
        $this->attributes['url'] = $this->generateUrl();
    }

    /* 
        METODOS
    */

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function validateApproval(){
        if($this->title && $this->extract && $this->body &&$this->published_at && $this->user_id && $this->category_id){
            return true;
        }

        return false;
    }

    public function updateApproved(){
        $this->update([
            'approved' => 1
        ]);

        return [
            'success' => true, 
            'message' => 'El Post <strong>' . $this->title .'</strong> fue actualizado su estado a <strong>Aprobado</strong>',
            'title' => 'Post Actualizado',
            'icon' => 'success'
        ];
    }

    public function updateDisapprove(){
        $this->update([
            'approved' => 0
        ]);

        return [
            'success' => true, 
            'message' => 'El Post <strong>' . $this->title .'</strong> fue actualizado su estado a <strong>Desaprobado</strong>',
            'title' => 'Post Actualizado',
            'icon' => 'success'
        ];
    }

    public function scopeApproveds($query){
        return $query->whereNotNull('published_at')
                     ->where('published_at', '<=' , Carbon::now())
                     ->where('approved', true); 
    }

    public function scopeOwner($query){
        if(current_user()->hasRole('Admin') 
        || current_user()->hasRole('Moderator') 
        || (current_user()->hasPermissionTo('View Posts') && !current_user()->hasRole('Writter'))){

            return $query;
        }

        return $query->where('user_id', '=' , current_user()->id);
    }

    public function isVisibled(){
        return (bool) $this->published_at && $this->published_at <= today() && $this->approved;
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

        return $url;
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
