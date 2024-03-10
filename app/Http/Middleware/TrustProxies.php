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
        // Resolve domain names to IP addresses
        $trustedProxies = [
            // Replace example.com with your actual domain name
            gethostbyname('https://droghers-hub-portaldemo-v1-uat.azurewebsites.net/'),
            // Add more domain names as needed
        ];

        // Set trusted proxies dynamically
        $request->setTrustedProxies($trustedProxies, Request::HEADER_X_FORWARDED_ALL);

        return $next($request);
    }
}
