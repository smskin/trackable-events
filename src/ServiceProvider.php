<?php

namespace SMSkin\TrackableEvents;

use Illuminate\Contracts\Queue\Factory as QueueFactoryContract;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->app->singleton(Dispatcher::class, function (Application $app) {
            return (new Dispatcher($app))->setQueueResolver(function () use ($app) {
                return $app->make(QueueFactoryContract::class);
            });
        });

        $this->app->alias(
            Dispatcher::class,
            'events'
        );

        $this->app->alias(
            Dispatcher::class,
            \Illuminate\Contracts\Events\Dispatcher::class
        );

    }
}