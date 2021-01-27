<?php

namespace App\Listeners;

use App\User;
use App\Events\CommentWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\NotifyCommentCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendNotificationToUserModerator
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
        Notification::send(
            User::role('Moderator')->get(), 
            new NotifyCommentCreated($event->comment)
        );
    }
}
