<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PlaylistClass extends Constraint
{
    public $message = 'There is at least two value of playlist association which are not null';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

}