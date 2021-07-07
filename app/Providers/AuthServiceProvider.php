<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        'App\Post' => 'App\Policies\PostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

         /* define a admin user role */
         Gate::define('isAdmin', function($user) {
            return $user->role == '3';
         });

         /* define a manager user role */
         Gate::define('isManager', function($user) {
             return $user->role == '2';
         });

         /* define a user role */
         Gate::define('isUser', function($user) {
             return $user->role == '1';
         });
    }
}
