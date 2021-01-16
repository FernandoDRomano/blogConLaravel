<?php

namespace App;

use App\Notifications\ResetPasswordNotification;
use App\Post;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_name', 'photo', 'active', 'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* 
        RELACIONES CON OTROS MODELOS
    */

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function token(){
        return $this->hasOne(UserToken::class);
    }

    /* 
        ACCESORES Y MUTADORES
    */

    public function setPhotoAttribute($value){
        if ($value === '/admin/img/foto_perfil.jpg') {
            $this->attributes['photo'] = $value;
        }else{
            $this->attributes['photo'] = '/storage/' . $value;
        }
    }

    /* 
        METODOS
    */

    public function getFullName(){
        return $this->last_name . ', ' . $this->name;
    }

    public function getRoleDisplayNames(){
        if ($this->roles->count()) {
            return $this->roles->implode('display_name', ', ');
        }

        return 'No tiene roles asignados';
    }

    public function getPermissionDisplayNames(){
        if ($this->permissions->count()) {
            return $this->permissions->implode('display_name', ', ');
        }

        return 'No tiene permisos asignados';
    }

    public function createUser($request, $password)
    {
        $this->fill($request);
        $this->password = bcrypt($password);
        $this->active = true;
        $this->photo = '/admin/img/foto_perfil.jpg';
        $this->save();

        
        $this->syncRolesUser($request);
        $this->syncPermissionsUser($request);
    }

    public function updateUser($request)
    {
        $this->fill($request);
        $this->update();

        $this->syncRolesUser($request);
        $this->syncPermissionsUser($request);
    }

    public function updateProfile($request){
        $this->fill($request);
        isset($request['photo']) ? $this->photo = $request['photo']->store('users') : $this->photo;
        isset($request['password']) ? $this->password = bcrypt($request['password']) : $this->password;
        $this->update();
    }

    public function updatePassword($request){
        $this->password = bcrypt($request['password']);
        $this->update();
    }

    public function syncRolesUser($request){
        if (empty($request['roles'])) {
            $this->syncRoles();
        }else{
            $this->syncRoles($request['roles']);
        }
    }

    public function syncPermissionsUser($request){
        if (empty($request['permissions'])) {
            $this->syncPermissions();
        }else{
            $this->syncPermissions($request['permissions']);
        }
    }

    public function generateTokenActivate(){
        $this->token()->create(['token' => Str::random(60)]);
    }

    public function activeUser()
    {
        $this->update(['active' => true, 'email_verified_at' => Carbon::now()]);
        $this->token->delete();

        Auth::login($this);
    }

    /* REESCRIBIENDO EL METODO QUE ENVIA LA NOTIFICACIÓN DE RECUPERACIÓN DE CONTRASEÑA */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

}
