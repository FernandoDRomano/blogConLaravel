<?php

namespace App\Listeners;

use App\User;
use App\Events\PostWasCreated;
use App\Notifications\NotifyPostCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendNotificationToUserModeratorForPostCreated
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
     * @param  PostWasCreated  $event
     * @return void
     */
    public function handle(PostWasCreated $event)
    {
        Notification::send(
            User::role('Moderator')->get(),
            new NotifyPostCreated($event->post)
        );
    }
}
