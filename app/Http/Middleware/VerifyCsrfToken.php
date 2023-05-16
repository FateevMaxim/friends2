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
        '*',
        '/dashboard',
        'china-product',
        'file-import',
        'almatyin-product',
        'getinfo-product',
        'almatyout-product'
    ];
}
