<?php

namespace Inoplate\Auth\Http\Middleware;

use Closure;
use Roseffendi\Authis\Authis;
use Roseffendi\Authis\Resource;

class Authorize
{
    /**
     * @var Roseffendi\Authis\Authis
     */
    protected $authis;

    /**
     * Create new Authorize instance
     * 
     * @param Authis $authis
     */
    public function __construct(Authis $authis)
    {
        $this->authis = $authis;
    }

    /**
     * Handle an incoming request.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  Closure                   $next
     * @param  mixed                     $resource
     * @param  string|null               $ablity
     * @return mixed
     */
    public function handle($request, Closure $next, $resource = null, $ability = null)
    {
        // Naming convention of ability
        // Taken from route name
        $ability = $ability ?: $request->route()->getName();
        $resource = $resource ? $request->route($resource) : null;
        $authis = $resource ? $this->authis->forResource($resource) : $this->authis;

        if( !$authis->check($ability)) {
            if ($request->ajax()) {
                return response('Unauthorized.', 403);
            } else {
                return back()->with([
                                'error' => trans('inoplate-account::messages.auth.unauthorized',
                                    ['url' => $request->url() ])
                                ]);
            }
        }

        return $next($request);
    }
}
