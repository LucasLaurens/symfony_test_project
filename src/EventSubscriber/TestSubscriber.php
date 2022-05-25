<?php

namespace App\EventSubscriber;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class TestSubscriber implements EventSubscriberInterface
{
    public function getResponse(RequestEvent $event)
    {
        dd($event->getRequest(), $event->getKernel(), $event->getResponse());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => 'getResponse'
        ];
    }
}
