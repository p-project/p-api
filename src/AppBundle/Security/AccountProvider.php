<?php

namespace AppBundle\Security;

use AppBundle\Entity\Account;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

class AccountProvider implements UserProviderInterface
{

    private $repository;

    public function __construct(EntityManager $em)
    {
        $this->repository = $em->getRepository('AppBundle:Account');
    }

    public function loadUserByUsername($username)
    {
        $account = $this->repository->findOneByUsername($username);

        if (null === $account) {
            throw new UsernameNotFoundException('No account found for email');
        }

        return $account;
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof Account) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return Account::class === $class;
    }
}
