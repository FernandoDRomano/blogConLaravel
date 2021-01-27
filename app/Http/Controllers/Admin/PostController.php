<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Post;
use App\Image;
use App\Comment;
use App\Category;
use Illuminate\Http\Request;
use App\Events\PostWasCreated;
use App\Events\PostWasDeleted;
use App\Http\Controllers\Controller;
use App\Events\PostWasUpdateApproved;
use App\Events\PostWasUpdateDisapproved;
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

        event(new PostWasCreated($post));

        return response()->json([
            'success' => 'true', 
            'url' => route('admin.posts.edit', $post),
        ]);
    }

    public function show(Post $post)
    {
        $this->authorize('show', $post);

        return view('public.post.show', [
            "post" => $post,
            "comments" => $post->comments,
            "comment" => new Comment
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

        event(new PostWasDeleted($post->title, $post->user));

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
            if ($post->approved) {
                $message = $post->updateDisapprove();

                event(new PostWasUpdateDisapproved($post));

                return redirect()->route('admin.posts.index')->with($message);
            }else{
                $message = $post->updateApproved();

                event(new PostWasUpdateApproved($post));

                return redirect()->route('admin.posts.index')->with($message);
            }
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
