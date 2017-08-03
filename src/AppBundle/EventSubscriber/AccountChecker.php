<?php

namespace AppBundle\EventSubscriber;

use AppBundle\Entity\Profile;
use AppBundle\Security\AccountVoter;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

class AccountChecker implements EventSubscriberInterface
{
    private $accountVoter;
    private $tokenStorage;

    public function __construct(AccountVoter $accountVoter, TokenInterface $tokenStorage)
    {
        $this->accountVoter = $accountVoter;
        $this->tokenStorage = $tokenStorage;
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

        if (!correctValue($profile)) {
            $response = new Response('You don\'t have access to this account', Response::);
            $event->setResponse($response);
        }
    }

    private function correctValue(Profile $profile)
    {
        $this->accountVoter->vote($this->tokenStorage, $profile, $profile->getAccount()) === VoterInterface::ACCESS_GRANTED;
    }

}