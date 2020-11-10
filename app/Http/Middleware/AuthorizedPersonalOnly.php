<?php

namespace App\Http\Middleware;

use Closure;

class AuthorizedPersonalOnly
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
        if (auth()->check() && auth()->user()->role->name !== "Subscriber"){
            return $next($request);
        }

        return redirect()->route('pages.blog');
    }
}
