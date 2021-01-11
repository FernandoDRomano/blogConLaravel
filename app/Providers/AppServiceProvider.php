<?php

namespace App\Providers;

use App\Tag;
use App\Post;
use App\User;
use App\Image;
use App\Comment;
use App\Category;
use App\Observers\PostObserver;
use App\Observers\ImageObserver;
use App\Observers\CommentObserver;
use Spatie\Permission\Models\Role;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;

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

        view()->share([
            'post' => new Post,
            'user' => new User,
            'comment' => new Comment,
            'tag' => new Tag,
            'category' => new Category,
            'role' => New Role,
            'permission' => new Permission
        ]);
    }
}
