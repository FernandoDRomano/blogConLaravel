<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'Spatie\Permission\Models\Permission' => 'App\Policies\PermissionPolicy',
        'Spatie\Permission\Models\Role' => 'App\Policies\RolePolicy',
        'App\User' => 'App\Policies\UserPolicy',
        'App\Tag' => 'App\Policies\TagPolicy',
        'App\Category' => 'App\Policies\CategoryPolicy',
        'App\Post' => 'App\Policies\PostPolicy',
        'App\Comment' => 'App\Policies\CommentPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-dashboard', function($user){
            return !$user->hasRole('Subscriber');
        });
    }
}
