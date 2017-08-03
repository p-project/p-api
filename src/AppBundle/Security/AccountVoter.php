<?php

namespace AppBundle\Security;

use AppBundle\Entity\Account;
use AppBundle\Entity\Profile;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class AccountVoter extends Voter
{
    const ACCESS = 'access';

    protected function supports($attribute, $subject)
    {
        if ($attribute !== self::ACCESS) {
            return false;
        }

        if (!$subject instanceof Account) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof Profile) {
            return false;
        }

        $profile = $subject;

        if ($attribute === self::ACCESS) {
            return $this->canAccess($profile, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canAccess(Profile $profile, Account $account)
    {
        return $profile->getAccount()->getId() === $account->getId();
    }
}