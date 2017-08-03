<?php

namespace AppBundle\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use AppBundle\Entity\Profile;
use AppBundle\Security\AccountVoter;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

class PasswordEncryption implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => [['encryptPassword', EventPriorities::PRE_WRITE]],
        ];
    }

    public function encryptPassword(GetResponseForControllerResultEvent $event)
    {
        $profile = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$profile instanceof Profile || Request::METHOD_POST !== $method) {
            return;
        }

        $profile->getAccount()
            ->setSalt(base_convert(uniqid(mt_rand(), true), 16, 36))
            ->setPassword($this->container->get('security.password_encoder')
                ->encodePassword($profile->getAccount(), 'password'))
        ;
    }
}