<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\SaveUserRequest;

class SubscriberController extends Controller
{
    public function edit(User $user){
        $this->authorize('viewProfile', $user);
        
        return view('public.users.profile')->with(['user' => $user->load('socialProfiles')]);
    }

    public function update(SaveUserRequest $request, User $user){
        $this->authorize('updateProfile', $user);

        $user->updateProfile($request->validated());
        return redirect()->route('subscriber.profile', $user)->with([
            'message' => 'Los datos del perfil fueron actualizados con éxito!!!', 
            'title' => 'Datos Actualizados', 
            'icon' => 'success'
        ]);
    }
}
