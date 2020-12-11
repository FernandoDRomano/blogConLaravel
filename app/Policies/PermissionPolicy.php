<?php

namespace App\Policies;

use App\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;
    
    public function view(User $user, Permission $permission)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('View Permissions');
    }

    public function update(User $user, Permission $permission)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Update Permissions');
    }


}
