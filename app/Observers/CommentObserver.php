<?php

namespace App\Observers;

use App\Comment;

class CommentObserver
{

    public function creating(Comment $comment)
    {
        if (current_user()) {
            $comment->user_id = current_user()->id;
        }
    }

}
