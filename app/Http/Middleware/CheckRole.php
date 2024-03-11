<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $roleId)
    {
        if (auth()->check() && auth()->user()->rol_id == $roleId) {
            return $next($request);
        }

        // Redirect to a specific page or show an error message
        abort(403, 'Unauthorized action.');
    }
}