<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\UserWasCreated' => [
            'App\Listeners\SendEmailToCreatedUser',
        ],
        'Illuminate\Auth\Events\Registered' => [
            'App\Listeners\SendEmailToRegisteredUser',
        ],
        'App\Events\CommentWasCreated' => [
            'App\Listeners\SendNotificationToUserModerator',
            'App\Listeners\SendNotificationToUserOwnerOfCommentWithReply',
        ],
        'App\Events\PostWasCreated' => [
            'App\Listeners\SendNotificationToUserModeratorForPostCreated',
        ],
        'App\Events\PostWasDeleted' => [
            'App\Listeners\SendNotificationToUserOwnerOfPostDeleted',
        ],
        'App\Events\PostWasUpdateApproved' => [
            'App\Listeners\SendNotificationToUserOwnerOfPostApproved',
        ],
        'App\Events\PostWasUpdateDisapproved' => [
            'App\Listeners\SendNotificationToUserOwnerOfPostDesapproved',
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
