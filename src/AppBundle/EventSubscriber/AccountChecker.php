<?php

namespace AppBundle\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class AccountChecker implements EventSubscriberInterface
{
    private $authorizationChecker;

    public function __construct(AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => [['onKernelRequest', EventPriorities::PRE_READ]],
        ];
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $method = $event->getRequest()->getMethod();
        $arrayPath = explode('/', $event->getRequest()->getPathInfo());

        if (Request::METHOD_POST === $method || $arrayPath[1] !== 'user_accounts') {
            return;
        }

        if (!$this->authorizationChecker->isGranted('access', $arrayPath)) {
            $response = new Response('You don\'t have access to this account', Response::HTTP_FORBIDDEN);
            $event->setResponse($response);
        }
    }
}
