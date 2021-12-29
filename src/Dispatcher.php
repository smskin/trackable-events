<?php

namespace SMSkin\TrackableEvents;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use SMSkin\TrackableEvents\Events\EventDispatched;
use SMSkin\TrackableEvents\Events\EventDispatching;
use SMSkin\TrackableEvents\Interfaces\TrackableEvent;
use Illuminate\Events\Dispatcher as BaseDispatcher;

class Dispatcher extends BaseDispatcher implements DispatcherContract
{
    public function dispatch($event, $payload = [], $halt = false)
    {
        if ($this->isTrackableEvent($event)) {
            $this->dispatch(new EventDispatching($event, $payload, $halt));
        }

        $result = parent::dispatch($event, $payload, $halt);

        if ($this->isTrackableEvent($event)) {
            $this->dispatch(new EventDispatched($event, $payload, $halt));
        }

        return $result;
    }

    private function isTrackableEvent($event): bool
    {
        return $event instanceof TrackableEvent;
    }
}