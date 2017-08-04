<?php

namespace AppBundle\Security;

use AppBundle\Entity\UserAccount;
use AppBundle\Entity\UserProfile;
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

        if ($subject === null) {
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

        $profileId = explode('/', $subject)[2];


        if ($attribute === self::ACCESS) {
            return $this->canAccess($profileId, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canAccess(string $profileId, UserAccount $account)
    {
        return $account->getId() === intval($profileId);
    }
}