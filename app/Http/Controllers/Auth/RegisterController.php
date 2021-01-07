<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messagesCustom = [
            'name.required' => 'El nombre es requerido',
            'name.max' => 'El nombre debe tener como máximo 255 caracteres',
            'name.string' => 'El nombre es debe ser una cadena de caracteres',
            'last_name' => 'El apellido es requerido',
            'last_name.max' => 'El apellido debe tener como máximo 255 caracteres',
            'last_name.string' => 'El apellido es debe ser una cadena de caracteres',
            'email.required' => 'El email es requerido',
            'email.max' => 'El email debe tener como máximo 255 caracteres',
            'email.email' => 'El email no tiene un formato válido',
            'email.unique' => 'Este email ya se encuentra registrado en nuestros servidores',
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe tener como mínimo 8 caracteres',
            'password.confirmed' => 'Las contraseñas ingresadas no coinciden'
        ];

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], $messagesCustom);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'photo' => '/admin/img/foto_perfil.jpg',
        ]);

        $user->assignRole('Subscriber');
        $user->givePermissionTo('Create Comments');
    
        return $user;
    }
}
