<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->is_admin==false) {
            return $next($request);
        } else {
            Auth::logout();
            return redirect('/');
        }
    }
}
