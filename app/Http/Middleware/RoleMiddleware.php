<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = Auth::user();

        if (!$user) {
            // Redirect guests to role-specific login if available
            if ($role === 'student' && route('student.login', [], false)) {
                return redirect()->guest(route('student.login'));
            }

            return redirect()->guest(route('login'));
        }

        if (!isset($user->role) || $user->role !== $role) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
