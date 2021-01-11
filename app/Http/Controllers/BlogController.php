<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    
    public function index(){
        return view('public.post.index', [
            "posts" => Post::approveds()->with(['user', 'tags', 'category', 'images'])->paginate(),
        ]);
    }

    public function show(Post $post){
        if($post->isVisibled()){
            return view('public.post.show', [
                "post" => $post,
                "comments" => $post->comments->load('childs'),
                'comment' => new Comment
            ]);
        }

        abort(404);
    }

    public function showPostsByCategory(Category $category){
         return view('public.post.index', [
             "posts" => $category->posts()->approveds()->paginate(),
             "title" => "Posts de la Categoría " . $category->name
         ]);
    }

    public function showPostsByTag(Tag $tag){
        return view('public.post.index', [
            "posts" => $tag->posts()->approveds()->paginate(),
            "title" => "Posts de la Etiqueta " . $tag->name
        ]);
    }

}
