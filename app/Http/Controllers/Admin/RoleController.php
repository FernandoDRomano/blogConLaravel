<?php

namespace App\Http\Controllers\Admin;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveRoleRequest;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function index()
    {
        $this->authorize('view', new Role);
        return view('admin.roles.index', [
            "roles" => Role::all()
        ]);
    }

    public function getRole(Role $role){
        $this->authorize('view', $role);
        return response()->json($role);
    }


    public function create()
    {
        $this->authorize('create', $role = new Role);
        return view('admin.roles.create', [
            "role" => $role,
            "permissions" => Permission::all()
        ]);
    }

    public function store(SaveRoleRequest $request)
    {
        $this->authorize('create', new Role);
        $role = Role::create($request->validated());
        $role->givePermissionTo($request->permissions);

        return redirect()->route('admin.roles.index')->with([
            'message' => 'El Role <strong>' . $role->display_name . '</strong> fue creado con éxito!!!', 
            'title' => 'Role Creado', 
            'icon' => 'success'
        ]);
    }

    public function show(Role $role)
    {
        $this->authorize('view', $role);

        return view('admin.roles.show', [
            "role" => $role->load(['permissions', 'users'])
        ]);
    }

    public function edit(Role $role)
    {
        $this->authorize('update', $role);

        return view('admin.roles.edit', [
            "role" => $role,
            "permissions" => Permission::all()
        ]);
    }

    public function update(SaveRoleRequest $request, Role $role)
    {
        $this->authorize('update', $role);

        $role->update($request->validated());
        $role->syncPermissions($request->permissions);

        return redirect()->route('admin.roles.edit', $role)->with([
            'message' => 'Los datos fueron actualizados con éxito!!!',
            'title' => 'Role Actualizado',
            'icon' => 'success'
        ]); 
    }

    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);

        $role->delete();
        return redirect()->route('admin.roles.index')->with([
            'message' => 'El role <strong>' . $role->display_name . '</strong> fue eliminado con éxito!!!',
            'title' => 'Role Eliminado',
            'icon' => 'success'
        ]);
    }
}
