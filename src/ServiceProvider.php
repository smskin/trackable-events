<?php

namespace SMSkin\TrackableEvents;

use Illuminate\Contracts\Queue\Factory as QueueFactoryContract;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use \Illuminate\Events\Dispatcher as BaseDispatcher;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->app->extend(BaseDispatcher::class, function(BaseDispatcher $service, Application $app){
            return (new Dispatcher($app))->setQueueResolver(function () use ($app) {
                return $app->make(QueueFactoryContract::class);
            });
        });
    }
}