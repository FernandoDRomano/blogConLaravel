<?php

namespace App\Listeners;

use App\Events\PostWasDeleted;
use App\Notifications\NotifyPostDelete;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendNotificationToUserOwnerOfPostDeleted
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
     * @param  PostWasDeleted  $event
     * @return void
     */
    public function handle(PostWasDeleted $event)
    {
        Notification::send($event->user, new NotifyPostDelete($event->post));
    }
}
