<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class TrustProxies extends Middleware
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
        // Define HEADER_X_FORWARDED_ALL manually
        $headerXForwardedAll = 0b0000011111;
    
        // Get the IP address and port from the request headers
        $trustedProxies = [
            $request->getClientIp() . ':' . $request->getPort(),
        ];
    
        // Set trusted proxies dynamically
        $request->setTrustedProxies($trustedProxies, $headerXForwardedAll);
    
        return $next($request);
    }
}

