<?php

namespace App\Http\Middleware;

use Closure;

class SuperEditor
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
        if ( Auth::check() && Auth::user()->hasRole('super editor') )
        {
            return $next($request);
        }

        return redirect('home');
    }
}
