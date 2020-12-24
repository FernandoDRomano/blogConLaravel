<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function view(User $userAuth, User $userModel)
    {
        return $userAuth->hasRole('Admin') || $userAuth->hasPermissionTo('View Users') || $userAuth->id === $userModel->id;
    }

    public function create(User $userAuth)
    {
        return $userAuth->hasRole('Admin') || $userAuth->hasPermissionTo('Create Users');
    }

    public function update(User $userAuth, User $userModel)
    {
        return $userAuth->hasRole('Admin') || $userAuth->hasPermissionTo('Update Users') && $userModel->id !== 1;
    }

    public function viewProfile(User $userAuth, User $userModel){
        return $userAuth->id === $userModel->id;
    }

    public function updateProfile(User $userAuth, User $userModel){
        return $userAuth->id === $userModel->id;
    }

    public function updatePassword(User $userAuth, User $userModel){
        return $userAuth->id === $userModel->id;
    }

    public function delete(User $userAuth, User $userModel)
    {
        return $userAuth->hasRole('Admin') && $userModel->id !== 1 && $userAuth->id !== $userModel->id || $userAuth->hasPermissionTo('Delete Users') && $userModel->id !== 1 && $userAuth->id !== $userModel->id;
    }

    /**
     * Determine whether the user can restore the userModel.
     *
     * @param  \App\User  $user
     * @param  \App\User  $userModel
     * @return mixed
     */
    public function restore(User $userAuth, User $userModel)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the userModel.
     *
     * @param  \App\User  $user
     * @param  \App\User  $userModel
     * @return mixed
     */
    public function forceDelete(User $userAuth, User $userModel)
    {
        //
    }
}
