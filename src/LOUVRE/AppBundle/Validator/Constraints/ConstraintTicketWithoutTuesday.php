<?php

namespace LOUVRE\AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ConstraintTicketWithoutTuesday extends Constraint
{
    public $message = 'Vous ne pouvez pas commander de billet pour un mardi.';
}