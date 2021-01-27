<?php

namespace App\Listeners;

use App\Events\CommentWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\NotifyCommentReply;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendNotificationToUserOwnerOfCommentWithReply
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CommentWasCreated  $event
     * @return void
     */
    public function handle(CommentWasCreated $event)
    {
        if ($event->comment->parent_comment_id) {
            Notification::send($event->comment->parent->user, new NotifyCommentReply($event->comment->parent));    
        }
    }
}
