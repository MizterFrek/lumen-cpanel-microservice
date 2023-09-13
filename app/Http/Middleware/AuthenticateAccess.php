<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateAccess
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
        $acceptedSecrets = env('ACCEPTED_SECRETS');
        if( strlen($acceptedSecrets) == 0 )
        {
            abort(Response::HTTP_LOCKED);
        }

        $validSecrets = explode(',', $acceptedSecrets);
        if( in_array($request->header('Authorization'), $validSecrets) )
        {
            return $next($request);
        }
        abort(Response::HTTP_UNAUTHORIZED);
    }
}