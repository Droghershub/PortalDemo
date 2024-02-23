<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];

    /**
     * The CSRF token field name.
     *
     * @var string
     */
    protected $fieldName = '_token';

    /**
     * The CSRF token header key.
     *
     * @var string
     */
    protected $headerKey = 'X-CSRF-TOKEN'; // Update this line
}
