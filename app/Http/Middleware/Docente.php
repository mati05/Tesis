<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Redirect;

class Docente
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
        if(Auth::user() && Auth::user()->rol == 2){
            return $next($request);
        }
        return redirect()->route('401');
    }
}
