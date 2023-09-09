<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        Gate::define('Admin', function (Role $role) {
            return $role->name == 'Admin';
        });

        Gate::define('Artist', function (Role $role) {
            return $role->name == 'Artist';
        });

        Gate::define('Customer', function (Role $role) {
            return $role->name == 'Customer';
        });
    }
}
