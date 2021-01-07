<?php

namespace App\Policies;

use App\User;
use App\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;
    
    public function before($user, $ability){
        if ($user->hasRole('Admin')) {
            return true;
        }
    }

    public function view(User $user){
        return $user->hasPermissionTo('View Comments') || $user->hasRole('Moderator');
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('Create Comments');
    }

    public function update(User $user, Comment $comment)
    {
        return $user->hasPermissionTo('Update Comments') || $user->hasRole('Moderator');
    }

    public function delete(User $user, Comment $comment)
    {
        return $user->hasPermissionTo('Delete Comments') || $user->hasRole('Moderator');
    }

    public function restore(User $user, Comment $comment)
    {
        //
    }

    public function forceDelete(User $user, Comment $comment)
    {
        //
    }
}
