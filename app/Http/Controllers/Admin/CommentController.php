<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Events\CommentWasCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Notifications\NotifyCommentDelete;
use App\Notifications\NotifyCommentApproved;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NotifyCommentDisapprove;

class CommentController extends Controller
{

    public function index()
    {
        $this->authorize('view', new Comment);

        return view('admin.comments.index', [
            'comments' => Comment::latest()->with(['user', 'post'])->get(),
        ]);
    }

    public function store(CommentRequest $request)
    {
        $this->authorize('create', new Comment);

        $comment = Comment::create($request->validated());

        event(new CommentWasCreated($comment));

        return redirect()->back()->with([
            'success' => true, 
            'message' => 'El Comentario <strong>' . $comment->body .'</strong> fue creado con éxito, <strong class="text-info">ahora debes esperar a que sea aprobado por nuestros Moderadores</strong>!!!',
            'title' => 'Comentario Creado',
            'icon' => 'success'
        ]);
    }

    public function getComment(Comment $comment){
        return response()->json($comment->load(['user', 'post', 'childs']));

    }

    public function updateApproved(Comment $comment){
        $this->authorize('update', $comment);

        if ($comment->approved) {
            $comment->approved = 0;
            Notification::send($comment->user, new NotifyCommentDisapprove($comment));
        }else{
            $comment->approved = 1;
            Notification::send($comment->user, new NotifyCommentApproved($comment));
        }

        $comment->save();

        return redirect()->route('admin.comments.index')->with([
            'success' => true, 
            'message' => 'El Comentario <strong>' . $comment->body .'</strong> fue actualizado su estado a <strong>' . ($comment->approved ? 'Aprobado' : 'Desaprobado') . '</strong>',
            'title' => ($comment->approved ? 'Comentario Aprobado' : 'Comentario Desaprobado'),
            'icon' => 'success'
        ]);
    }


    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        Notification::send($comment->user, new NotifyCommentDelete($comment->body));

        return redirect()->route('admin.comments.index')->with([
            'success' => true, 
            'message' => 'El Comentario <strong>' . $comment->body .'</strong> fue eliminado con éxito!!!',
            'title' => 'Comentario Eliminado',
            'icon' => 'success'
        ]);
    }
}
