<?php

namespace App\Http\Middleware;

use Closure;

/**
 * This middleware adds headers to *every* response
 * that is processed by Laravel.
 */
class AddHeaders
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        
        // This header prevents clickjacking attacks by
        // disallowing embedding the site in an iframe
        $response->header('X-Frame-Options', 'DENY');

        return $response;
    }
}
