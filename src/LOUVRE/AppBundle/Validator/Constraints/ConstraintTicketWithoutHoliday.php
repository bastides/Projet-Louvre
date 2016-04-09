<?php

namespace LOUVRE\AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ConstraintTicketWithoutHoliday extends Constraint
{
    public $message = 'Vous ne pouvez pas commander de billet un jour férié.';    
}