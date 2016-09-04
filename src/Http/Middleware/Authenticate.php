<?php

namespace Inoplate\Auth\Http\Middleware;

use Closure;
use Event;
use Inoplate\Auth\Events\UserAuthenticated;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login')
                                 ->with('error', trans('inoplate-auth::messages.unauthenticated'));
            }
        }

        Event::fire(new UserAuthenticated($request->user()));

        return $next($request);
    }
}