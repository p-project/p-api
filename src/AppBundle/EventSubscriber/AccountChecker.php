<?php

namespace AppBundle\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use AppBundle\Entity\UserProfile;
use AppBundle\Security\AccountVoter;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

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

        if (Request::METHOD_POST === $method || $event->getRequest()->getPathInfo() === '/oauth/v2/token') {
            return;
        }

        if (!$this->authorizationChecker->isGranted('access', $event->getRequest()->getPathInfo())) {
            $response = new Response('You don\'t have access to this account', Response::HTTP_FORBIDDEN);
            $event->setResponse($response);
        }

    }
}