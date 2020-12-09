<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Post;
use App\Image;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{

    public function index()
    {
        return view('admin.posts.index', [
            "posts" => Post::orderBy('created_at')->with(['user', 'category', 'images', 'tags'])->get(),
        ]);
    }

    public function getPost(Post $post)
    {
        return response()->json($post);
    }

    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $post->createPost($request);
        return response()->json(['success' => 'true', 'url' => route('admin.posts.edit', $post)]);
    }

    public function show(Post $post)
    {
        return view('public.post.show', [
            "post" => $post
        ]);
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', [
            "post" => $post,
            "categories" => Category::orderBy('name')->select('id', 'name')->get(),
            "tags" => Tag::orderBy('name')->select('id', 'name')->get(),
            "images" => $post->images
        ]);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->updatePostAndSyncTags($request);
        return redirect()->route('admin.posts.edit', $post)->with('message', 'Los cambios fueron guardados!!!');;
    }

    public function destroy(Post $post)
    {
        $post->deletePost();
        return redirect()->route('admin.posts.index')->with('message', 'El post ' . $post->title . ' fue eliminado con éxito!!!');
    }

    public function uploadImages(Post $post, Request $request){
        return $post->images()->create([
            'url' => $request->file('image')->store('images') 
         ]);
    }

    public function destroyImages(Image $image){
        $image->deleteImage();
        return response()->json(['success' => true, 'session' => 'Imagen eliminada']);
    }
}
