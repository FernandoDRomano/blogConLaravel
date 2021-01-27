<?php

namespace App\Http\Middleware;

use App\SocialProfile;
use Closure;

class SocialNetworkSupported
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if( collect(SocialProfile::$allowed)->contains($request->route('socialNetwork')) ){
            return $next($request);
        }

        return redirect()->route('login')->with([
            'message' => 'No puedes ingresar con este proveedor social <strong>' . $request->route('socialNetwork') . '</strong>', 
            'title' => 'Error', 
            'icon' => 'error'
        ]);

    }
}
