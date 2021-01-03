<?php

namespace App\Policies;

use App\User;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;
    
    public function before($user , $abivility)
    {
        if ($user->hasRole('Admin')) {
            return true;
        }
    }

    public function view(User $user, Post $post)
    {
        return $user->hasRole('Writter') || $user->hasPermissionTo('View Posts');
    }

    public function create(User $user)
    {
        return $user->hasRole('Writter') || $user->hasPermissionTo('Create Posts');
    }

    public function update(User $user, Post $post)
    {
        return ($user->hasRole('Writter') && $user->id === $post->user_id ) || $user->hasPermissionTo('Update Posts');
    }

    public function delete(User $user, Post $post)
    {
        return ($user->hasRole('Writter') && $user->id === $post->user_id ) || $user->hasPermissionTo('Delete Posts');
    }

    public function show(User $user, Post $post)
    {
        return ($user->hasRole('Writter') && $user->id === $post->user_id ) || $user->hasRole('Moderator') || $user->hasPermissionTo('Show Posts');
    }

    public function updateApproved(User $user, Post $post)
    {
        return $user->hasRole('Moderator') || $user->hasPermissionTo('Update Approved Posts');
    }

    public function restore(User $user, Post $post)
    {
        //
    }

    public function forceDelete(User $user, Post $post)
    {
        //
    }
}
