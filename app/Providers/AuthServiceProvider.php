<?php

namespace App\Providers;

use App\Auth\UpgradeUserProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        \Auth::provider('upgrade', function ($app, array $config) {
            return new UpgradeUserProvider($app['hash'], $config['model']);
        });
    }
}
