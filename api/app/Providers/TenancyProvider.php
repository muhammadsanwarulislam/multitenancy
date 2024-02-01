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

        // $this->configureQueue();
    }

    /**
     *
     */
    public function configureRequests()
    {
        if (! $this->app->runningInConsole()) {
            $host = str_replace(['https://','http://',':3000'], '', $this->app['request']->headers->get('Origin'));
            Tenant::whereDomain($host)->first()?->configure()?->use();
        }
    }

    /**
     *
     */
    public function configureQueue()
    {
        $this->app['queue']->createPayloadUsing(function () {
            return $this->app['tenant'] ? ['tenant_id' => $this->app['tenant']->id] : [];
        });

        $this->app['events']->listen(JobProcessing::class, function ($event) {
            if (isset($event->job->payload()['tenant_id'])) {
                Tenant::find($event->job->payload()['tenant_id'])->configure()->use();
            }
        });
    }
}