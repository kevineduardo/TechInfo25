<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class VerifyTeacher
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
        $user = Auth::user();
        if(!$user->teacher()) {
            redirect()->route('portal_inicio');
        }
        
        return $next($request);
    }
}
