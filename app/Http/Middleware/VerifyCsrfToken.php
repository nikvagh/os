<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Session;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $addHttpCookie = true;
    
    protected $except = [
        '/pay-via-ajax', '/success_ssl','/cancel','/fail_ssl','/ipn_ssl'
    ];
}
