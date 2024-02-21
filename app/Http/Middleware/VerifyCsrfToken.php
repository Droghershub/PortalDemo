<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \Illuminate\Session\TokenMismatchException
     */
    public function handle($request, Closure $next)
    {
        // Add your conditions here to handle CSRF token verification

        try {
            return parent::handle($request, $next);
        } catch (TokenMismatchException $e) {
            // Handle the TokenMismatchException here
            // For example, you could return a custom response or redirect the user
            // return response()->json(['error' => 'CSRF token mismatch'], 412);
            throw new HttpException(412, 'CSRF token mismatch', $e);
        }
    }
}

