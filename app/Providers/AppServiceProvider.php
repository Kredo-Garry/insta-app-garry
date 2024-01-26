<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate; //handle the access of entry
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\User;

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
        Gate::define('admin', function($user){
            return $user->role_id === User::ADMIN_ROLE_ID;
        });

        Paginator::useBootstrap();
    }
}
