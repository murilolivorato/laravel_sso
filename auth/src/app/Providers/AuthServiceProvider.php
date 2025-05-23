<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

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
        $this->registerPolicies();
        Passport::ignoreRoutes();

        Passport::tokensExpireIn(now()->addDay(1));
        Passport::refreshTokensExpireIn(now()->addDay(30));
        Passport::personalAccessTokensExpireIn(now()->addMonth(6));

        Passport::tokensCan([
            'access-supervisor-area' => 'Access Supervisor Area'
        ]);

       /* Passport::tokensCan([
            'view-user' => 'View User Information'
        ]);*/
    }
}
