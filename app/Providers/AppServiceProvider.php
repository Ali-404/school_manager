<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route as RouteFacade;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register role middleware alias so routes can use 'role:manager' or 'role:student'
        if ($this->app->bound('router')) {
            $this->app['router']->aliasMiddleware('role', \App\Http\Middleware\RoleMiddleware::class);
        }

        // Customize redirect for authenticated users: send them to appropriate dashboard
        RedirectIfAuthenticated::redirectUsing(function ($request) {
            $user = Auth::user();
            if ($user && isset($user->role)) {
                if ($user->role === 'manager' && RouteFacade::has('manager.dashboard')) {
                    return route('manager.dashboard');
                }
                if ($user->role === 'student' && RouteFacade::has('student.modules')) {
                    return route('student.modules');
                }
            }

            return '/';
        });
    }
}
