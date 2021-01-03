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
        $this->authorize('view', $post = new Post);

        return view('admin.posts.index', [
            "posts" => Post::Owner()->latest()->with(['user', 'category', 'tags'])->get(),
            'post' => $post,
        ]);
    }

    public function getPost(Post $post)
    {
        return response()->json($post);
    }

    public function store(StorePostRequest $request)
    {
        $this->authorize('create', new Post);

        $post = Post::create($request->validated());

        return response()->json([
            'success' => 'true', 
            'url' => route('admin.posts.edit', $post),
        ]);
    }

    public function show(Post $post)
    {
        $this->authorize('show', $post);

        return view('public.post.show', [
            "post" => $post
        ]);
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('admin.posts.edit', [
            "post" => $post,
            "categories" => Category::orderBy('name')->select('id', 'name')->get(),
            "tags" => Tag::orderBy('name')->select('id', 'name')->get(),
            "images" => $post->images
        ]);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $post->updatePostAndSyncTags($request);
        return redirect()->route('admin.posts.edit', $post)->with([
            'message' => 'Los datos fueron guardados con éxito!!!',
            'title' => 'Post Actualizado',
            'icon' => 'success'
        ]);;
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('admin.posts.index')->with([
            'success' => true, 
            'message' => 'El Post <strong>' . $post->title .'</strong> fue eliminado con éxito!!!',
            'title' => 'Post Eliminado',
            'icon' => 'success'
        ]);
    }

    public function updateApproved(Post $post){
        $this->authorize('update-approved', $post);

        if ($post->validateApproval()) {
            return redirect()->route('admin.posts.index')->with($post->updateApprovedOrDisapprove());
        }

        return redirect()->route('admin.posts.index')->with([
            'success' => true, 
            'title' => 'Error Ups',
            'message' => 'El post que intenta Aprobar no tiene todos sus campos completos',
            'icon' => 'error'
        ]);
    }

    public function uploadImages(Post $post, Request $request){
        $this->authorize('update', $post);

        return $post->images()->create([
            'url' => $request->file('image')->store('images') 
         ]);
    }

    public function destroyImages(Post $post, Image $image){        
        $this->authorize('update', $post);

        $image->delete();
        return response()->json(['success' => true, 'session' => 'Imagen eliminada']);
    }
}
