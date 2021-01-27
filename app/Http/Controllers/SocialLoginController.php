<?php

namespace App\Http\Controllers;

use App\User;
use App\SocialProfile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class SocialLoginController extends Controller
{
    public function redirectToSocialNetwork($socialNetwork){
        // REDIRECCIONO AL PROVEEDOR
        return Socialite::driver($socialNetwork)->redirect();
    }

    public function handleSocialNetworkCallback($socialNetwork){
        // EL try catch POR SI FALLA ALGO, POR EJEMPLO AL CANCELAR LA SOLICITUD DE ACCEDER CON ALGUN PROVEEDOR
        try {
            //OBTENGO EL USUARIO DEL PROVEEDOR
            $userSocialite = Socialite::driver($socialNetwork)->user();
            //BUSCO SI EXISTE EN LA BASE DE DATOS UN PERFIL SOCIAL CON ESE ID UNICO Y ESE PROVEEDOR, SI NO EXISTE ME DEVUELVE UNA 
            //INSTANCIA DE SocialProfile, NO LO ALMACENA AUN EN LA BASE DE DATOS
            $socialProfile = SocialProfile::firstOrNew([
                'social_network_user_id' => $userSocialite->getId(),
                'social_network' => $socialNetwork
            ]);

            // PREGUNTO SI NO EXISTE ESTA INSTANCIA DE SocialProfile EN LA BASE DE DATOS
            if (! SocialProfile::where('social_network_user_id', $socialProfile->social_network_user_id)->first()) {
                
                // AL NO EXISTIR LA INSTANCIA DE SociaProfile, BUSCO EN LA BASE DE DATOS SI HAY UN USUARIO CON EL EMAIL QUE ME DEVUELVE EL PROVEEDOR
                $user = User::firstOrNew(['email' => $userSocialite->getEmail()]);

                //PREGUNTO SI NO EXISTE ESTE USUARIO EN LA BASE DE DATOS
                if (! User::where('email', $userSocialite->getEmail())->first()) {

                    // AL NO EXISTIR EL USUARIO EN LA BASE DE DATOS SETEO SUS VALORES Y LO ALMACENO EN LA BASE DE DATOS
                    $user->name = $userSocialite->getName();
                    $user->photo = $userSocialite->getAvatar();
                    $user->active = true;
                    $user->email_verified_at = Carbon::now();
                    $user->save();

                    $user->assignRole('Subscriber');
                    $user->givePermissionTo('Create Comments');
                }

                //ASIGNO EL SocialProfile AL USUARIO
                $user->socialProfiles()->save($socialProfile);

            }

            Auth::login($socialProfile->user);

            return redirect()->route('pages.blog')->with([
                'message' => 'Bienvenido ' . $user->getFullName(), 
                'title' => 'Bienvenido', 
                'icon' => 'info'
            ]);
            

        } catch (\Exception $e) {
            
            return redirect()->route('login')->with([
                'message' => 'Ups ocurrio un error, por favor intente mas tarde.', 
                'title' => 'Error', 
                'icon' => 'error'
            ]);

        }

        
    }
}
