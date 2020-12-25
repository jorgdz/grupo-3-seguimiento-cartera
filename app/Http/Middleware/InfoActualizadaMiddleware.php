<?php

namespace App\Http\Middleware;

use Closure;

class InfoActualizadaMiddleware
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
        if (\Auth::user()->perfil_actualizado == false) 
        {
            return redirect()->route('inicio');
        }
        return $next($request);
    }
}
