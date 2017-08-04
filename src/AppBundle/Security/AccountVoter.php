<?php

namespace AppBundle\Security;

use AppBundle\Entity\UserAccount;
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

        if ($subject === null || !isset($subject[2])) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof UserAccount) {
            return false;
        }

        if ($attribute === self::ACCESS) {
            return $this->canAccess($subject[2], $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canAccess(string $profileId, UserAccount $account)
    {
        return $account->getId() === (int) $profileId;
    }
}
