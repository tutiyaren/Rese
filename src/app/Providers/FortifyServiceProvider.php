<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Validator;
use App\Rules\CustomValidationRule;
use App\Actions\Fortify\CreateNewAdmin; 
use App\Actions\Fortify\CreateNewRepresentative;
use Illuminate\Support\Facades\Route;

class FortifyServiceProvider extends ServiceProvider
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
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::createAdminsUsing(CreateNewAdmin::class);
        Fortify::createRepresentativesUsing(CreateNewRepresentative::class);

        Fortify::registerView(function () {
            return view('register');
        });

        Fortify::loginView(function () {
            return view('login');
        });

        Validator::extend('custom_rule', function ($attribute, $value, $parameters, $validator) {
            $rule = new CustomValidationRule();
            return $rule->passes($attribute, $value);
        });

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(10)->by($email . $request->ip());
        });

    }
}
