<?php

namespace App\Providers;

use App\Models\Tenant;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\ServiceProvider;

class TenancyProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRequests();

    }

    /**
     *
     */
    public function configureRequests()
    {
        if (! $this->app->runningInConsole()) {
            $host = $this->app['request']['domain'];
            Tenant::whereDomain($host)->first()?->configure()?->use(); 
        }
    }

}