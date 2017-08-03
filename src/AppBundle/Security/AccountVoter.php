<?php

namespace AppBundle\Security;

use AppBundle\Entity\Account;
use AppBundle\Entity\Profile;
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

    private function canAccess(Account $account, Profile $user)
    {
        return $user->getAccount()->getId() === $account->getId();
    }
}