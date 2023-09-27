<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // 管理者に許可
        Gate::define('admin-higher', function ($user) {
            return ($user->role >= 1 && $user->role <= 10);
        });

        // 店舗代表者に許可
        Gate::define('representative-higher', function ($user) {
            return ($user->role >= 11 && $user->role <= 40);
        });

        // 一般ユーザーに許可
        Gate::define('user-higher', function ($user) {
            return ($user->role > 41 && $user->role <= 140);
        });
    }
}
