<?php

namespace App\Listeners;

use App\Events\PostWasUpdateDisapproved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NotifyOwnerPostDisapprove;

class SendNotificationToUserOwnerOfPostDesapproved
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
     * @param  PostWasUpdateDisapproved  $event
     * @return void
     */
    public function handle(PostWasUpdateDisapproved $event)
    {
        Notification::send($event->post->user, new NotifyOwnerPostDisapprove($event->post));
    }
}
