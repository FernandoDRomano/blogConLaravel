<?php

namespace App\Policies;

use App\User;
use App\Tag;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
    use HandlesAuthorization;
    
    public function before($user, $avility){
        if($user->hasRole('Admin')){
            return true;
        }
    }

    public function view(User $user, Tag $tag)
    {
        return $user->hasPermissionTo('View Tags');
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('Create Tags');
    }

    public function update(User $user, Tag $tag)
    {
        return $user->hasPermissionTo('Update Tags');
    }

    public function delete(User $user, Tag $tag)
    {
        return $user->hasPermissionTo('Delete Tags');
    }

    /**
     * Determine whether the user can restore the tag.
     *
     * @param  \App\User  $user
     * @param  \App\Tag  $tag
     * @return mixed
     */
    public function restore(User $user, Tag $tag)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the tag.
     *
     * @param  \App\User  $user
     * @param  \App\Tag  $tag
     * @return mixed
     */
    public function forceDelete(User $user, Tag $tag)
    {
        //
    }
}
