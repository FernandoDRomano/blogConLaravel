<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\UserWasCreated;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveUserRequest;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\UserPasswordRequest;

class UserController extends Controller
{

    public function index()
    {

        $this->authorize('view', $user = new User);

        return view('admin.users.index', [
            'user' => $user,
            'users' => User::with(['roles', 'permissions'])->get()
        ]);
    }

    public function getUser(User $user){
        return response()->json($user);
    }

    public function create()
    {
        $this->authorize('create', $user = new User);

        return view('admin.users.create', [
            'user' => $user,
            'roles' => Role::all(),
            'permissions' => Permission::all()
        ]);
    }

    public function store(SaveUserRequest $request)
    {
        $this->authorize('create', $user = new User);

        $user->createUser($request->validated(), $password = Str::random(8));

        //ENVIAR EL EMAIL CON LA CONTRASEÑA
        UserWasCreated::dispatch($user, $password);

        //REDIRECCIONAR
        return redirect()->route('admin.users.index')->with([
            'message' => 'El Usuario <strong>' . $user->getFullName(). '</strong> fue creado con éxito!!!', 
            'title' => 'Usuario Creado', 
            'icon' => 'success'
        ]);
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);

        return view('admin.users.show', [
            'user' => $user->load(['roles', 'permissions', 'posts', 'comments'])
        ]);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('admin.users.edit', [
            'user' => $user->load(['roles', 'permissions']),
            'roles' => Role::all(),
            'permissions' => Permission::all()
        ]);
    }

    public function update(SaveUserRequest $request, User $user)
    {
        $this->authorize('update', $user);

       $user->updateUser($request->validated());
       return redirect()->route('admin.users.edit', $user)->with([
           'message' => 'Los datos del usuario fuerón actualizados con exito con éxito!!!', 
           'title' => 'Usuario Actualizado', 
           'icon' => 'success'
        ]);
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();
        return redirect()->route('admin.users.index')->with([
            'message' => 'El Usuario  <strong>' . $user->getFullName(). ' </strong> fue eliminado con éxito!!!', 
            'title' => 'Usuario Eliminado', 
            'icon' => 'success'
        ]);
    }

    public function profile(User $user){
        $this->authorize('viewProfile', $user);

        return view('admin.users.show', [
            "user" => $user
        ]);
    }

    public function editProfile(User $user){
        $this->authorize('viewProfile', $user);

        return view('admin.users.profile', [
            "user" => $user
        ]);
    }

    public function updateProfile(SaveUserRequest $request, User $user){
        $this->authorize('updateProfile', $user);

        $user->updateProfile($request->validated());
        return redirect()->route('admin.users.profile', $user)->with([
            'message' => 'Los datos del perfil fueron actualizados con éxito!!!', 
            'title' => 'Datos Actualizados', 
            'icon' => 'success'
        ]);
    }

    public function updatePassword(UserPasswordRequest $request, User $user){
        $this->authorize('updatePassword', $user);

        $user->updatePassword($request->validated());
        return response()->json([
            'success' => true, 
            'message' => 'La Contraseña fue actualizada con éxito!!!', 
            'title' => 'Contraseña Actualizada', 
            'icon' => 'success'
        ]);
    }
}
