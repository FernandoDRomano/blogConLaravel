<?php

namespace App\Listeners;

use App\User;
use App\Notifications\PostPublished;
use App\Events\PostWasUpdateApproved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NotifyOwnerPostApproved;
use App\Notifications\NotifyOwnerPostDisapprove;

class SendNotificationToUserOwnerOfPostApproved
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
     * @param  PostWasUpdateApproved  $event
     * @return void
     */
    public function handle(PostWasUpdateApproved $event)
    {
        Notification::send($event->post->user, new NotifyOwnerPostApproved($event->post));

        Notification::send(
            User::role('Subscriber')->get(), 
            new PostPublished($event->post)
        );
    }
}
