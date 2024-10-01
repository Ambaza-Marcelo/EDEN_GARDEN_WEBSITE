<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (Auth::guard('admin')) {
            if (!$request->expectsJson()) {
                return route('eden-garden-ressort');
            }
        } else {
            if (!$request->expectsJson()) {
                return route('login');
            }
        }
    }
}
