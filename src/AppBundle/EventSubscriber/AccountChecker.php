<?php

namespace AppBundle\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use AppBundle\Entity\Profile;
use AppBundle\Security\AccountVoter;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
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
            KernelEvents::REQUEST => [['checkAccountAccess', EventPriorities::POST_DESERIALIZE]],
        ];
    }

    public function checkAccountAccess(GetResponseForControllerResultEvent $event)
    {
        $profile = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$profile instanceof Profile || Request::METHOD_POST !== $method) {
            return;
        }

        if (!$this->authorizationChecker->isGranted('access', $profile)) {
            $response = new Response('You don\'t have access to this account', Response::HTTP_FORBIDDEN);
            $event->setResponse($response);
        }
    }
}