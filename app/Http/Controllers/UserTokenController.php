<?php

namespace App\Http\Controllers;

use App\UserToken;
use Illuminate\Http\Request;

class UserTokenController extends Controller
{
    
    public function active(UserToken $token)
    {
        $token->user->activeUser();

        return redirect()->route('pages.blog')->with([
            'message' => 'Felicidades tu cuenta ha sido activada con éxito!!!', 
            'title' => 'Cuenta Activada', 
            'icon' => 'success'
        ]);
    }

}
