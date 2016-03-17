<?php

namespace LOUVRE\AppBundle\Validator\Contraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ContraintHalfTicketValidator extends ConstraintValidator
{
    // Renvoie false si le billet est acheté après 14h
    public function validate($date, Constraint $constraint)
    {
        $todayMidnight = strtotime('today midnight');
        $today14h = $todayMidnight + (60 * 60 * 14);
        
        $currentTime = strtotime($date);
        
        if ($currentTime > $today14h) {
            return false;
        } else {
            return true;
        }
    }
}