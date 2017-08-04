<?php

namespace AppBundle\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use AppBundle\Entity\UserAccount;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

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
        /*$account = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$account instanceof UserAccount || $method !== Request::METHOD_POST) {
            return;
        }

        $account
            ->setSalt(base_convert(uniqid(mt_rand(), true), 16, 36))
            ->setPassword($this->container->get('security.password_encoder')
                ->encodePassword($account, 'password'))
        ;*/
    }
}
