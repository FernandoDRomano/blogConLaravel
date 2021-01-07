<?php

namespace App\Providers;

use App\Post;
use App\Image;
use App\Comment;
use App\Observers\PostObserver;
use App\Observers\ImageObserver;
use App\Observers\CommentObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Post::observe(PostObserver::class);
        Image::observe(ImageObserver::class);
        Comment::observe(CommentObserver::class);
    }
}
