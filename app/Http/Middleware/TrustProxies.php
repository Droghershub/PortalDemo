<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ResolveTrustedProxies
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
        // Resolve domain name to IP address
        $trustedProxies = [
            // Replace with the IP address of droghers-hub-portaldemo-v1-uat.azurewebsites.net
            '20.119.8.58', // IP address obtained by resolving the domain name
        ];

        // Set trusted proxies dynamically
        $request->setTrustedProxies($trustedProxies, Request::HEADER_X_FORWARDED_ALL);

        return $next($request);
    }
}
