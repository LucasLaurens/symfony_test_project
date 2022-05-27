<?php

namespace App\EventSubscriber;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class TestSubscriber implements EventSubscriberInterface
{
    private const PATH = 'test';
    private const REDIRECT_ROUTE_NAME = 'app_shipments';

    public function __construct(
        private UrlGeneratorInterface $router
    ) {
    }

    public function getResponse(ResponseEvent $event)
    {
        $request = $event->getRequest();
        $pathInfo = $request->getPathInfo();

        if (str_contains($pathInfo, self::PATH)) {
            $urlToRedirect = $this->router->generate(self::REDIRECT_ROUTE_NAME);
            $event->setResponse(new RedirectResponse($urlToRedirect));
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => ['getResponse',  3000]
        ];
    }
}
