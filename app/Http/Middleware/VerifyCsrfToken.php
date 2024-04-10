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
        '/product',
        '/shop',
        '/order',
        'order/9bbbc7a9-378c-4e21-b800-2146b36dd86d',
        'order/9bbbc7a9-38ac-4ec7-b95e-c63db21a6a79'
    ];
}
