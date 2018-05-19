<?php

namespace App\Http\Middleware;

use Closure;

class AWSMiddleware
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

        header('Access-Control-Allow-Origin: *');

       /* $request->header->add([
            'Access-Control-Allow-Origin' => '*'
        ]);*/

        return $next($request);
    }
}