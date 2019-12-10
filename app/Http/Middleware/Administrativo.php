<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Redirect;

class Administrativo
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
        if(Auth::user() && Auth::user()->rol == 1){
            return $next($request);
        }
        return redirect()->route('401');
    }
}
