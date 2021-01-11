<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\UpdatePermissionRequest;

class PermissionController extends Controller
{
    
    public function index(){
        $this->authorize('view', new Permission);

        return view('admin.permissions.index', [
            "permissions" => Permission::all()
        ]);
    }

    public function edit(Permission $permission){
        $this->authorize('update', $permission);

        return view('admin.permissions.edit', [
            "permission" => $permission
        ]);
    }

    public function update(UpdatePermissionRequest $request, Permission $permission){
        $this->authorize('update', $permission);
        
        $permission->update($request->validated());
        return redirect()->route('admin.permissions.edit', $permission)->with([
            'message' => 'Los datos fueron guardados con éxito!!!',
            'title' => 'Permiso Actualizado',
            'icon' => 'success'
        ]);
    }

}
