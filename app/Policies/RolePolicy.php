<?php

namespace App\Policies;

use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;
    


    /**
     * Determine whether the user can view the role.
     *
     * @param  \App\User  $user
     * @param  \Spatie\Permission\Models\Role  $role
     * @return mixed
     */
    public function view(User $user, Role $role)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('View Roles');
    }

    /**
     * Determine whether the user can create roles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Create Roles');
    }

    /**
     * Determine whether the user can update the role.
     *
     * @param  \App\User  $user
     * @param  \Spatie\Permission\Models\Role  $role
     * @return mixed
     */
    public function update(User $user, Role $role)
    {
        if( $role->name === 'Admin')
        {
            $this->deny('No se puede editar este role');
        }
        return $user->hasRole('Admin') || $user->hasPermissionTo('Update Roles');
    }

    /**
     * Determine whether the user can delete the role.
     *
     * @param  \App\User  $user
     * @param  \Spatie\Permission\Models\Role  $role
     * @return mixed
     */
    public function delete(User $user, Role $role)
    {
        if( $role->name === 'Admin')
        {
            $this->deny('No se puede eliminar este role');
        }

        return $user->hasRole('Admin') || $user->hasPermissionTo('Delete Roles');
    }

    /**
     * Determine whether the user can restore the role.
     *
     * @param  \App\User  $user
     * @param  \Spatie\Permission\Models\Role  $role
     * @return mixed
     */
    public function restore(User $user, Role $role)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the role.
     *
     * @param  \App\User  $user
     * @param  \Spatie\Permission\Models\Role  $role
     * @return mixed
     */
    public function forceDelete(User $user, Role $role)
    {
        //
    }
}
