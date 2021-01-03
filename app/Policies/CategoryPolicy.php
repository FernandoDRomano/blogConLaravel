<?php

namespace App\Policies;

use App\User;
use App\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;
    
    public function before($user, $avility){
        if($user->hasRole('Admin')){
            return true;
        }
    }

    public function view(User $user, Category $category)
    {
        return $user->hasPermissionTo('View Categories');
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('Create Categories');
    }

    public function update(User $user, Category $category)
    {
        return $user->hasPermissionTo('Update Categories');
    }

    public function delete(User $user, Category $category)
    {
        return $user->hasPermissionTo('Delete Categories');
    }

    /**
     * Determine whether the user can restore the category.
     *
     * @param  \App\User  $user
     * @param  \App\Category  $category
     * @return mixed
     */
    public function restore(User $user, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the category.
     *
     * @param  \App\User  $user
     * @param  \App\Category  $category
     * @return mixed
     */
    public function forceDelete(User $user, Category $category)
    {
        //
    }
}
