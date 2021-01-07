<?php

namespace App\Observers;

use App\Comment;

class CommentObserver
{

    public function creating(Comment $comment)
    {
        if (auth()->user()) {
            $comment->user_id = auth()->user()->id;
        }
    }

}
