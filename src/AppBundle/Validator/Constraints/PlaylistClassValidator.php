<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PlaylistClassValidator extends ConstraintValidator
{
    public function validate($playlist, Constraint $constraint)
    {
        if (!$this->ternaryXor($playlist->getChannel(), $playlist->getNetwork(), $playlist->getUserProfile())) {
            $this->context->buildViolation($constraint->message)->atPath('Playlist')->addViolation();
        }
    }

    public function ternaryXor($channel, $network, $account)
    {
        return ($channel === null && ($network !== null ^ $account !== null))
            || ($channel !== null && !($network !== null || $account !== null));
    }
}
