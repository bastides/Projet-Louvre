<?php

namespace LOUVRE\AppBundle\Validator\Contraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ContraintTicketValidator extends ConstraintValidator
{
    // Renvoie false si le billet est acheté à une date antérieur à aujourd'hui
    public function validate($dateInit, Constraint $constraint)
    {
        $date = strftime('%Y-%m-%d', strtotime(str_replace("/", "-", $dateInit)));
        
        $todayMidnight = strtotime('today midnight');
        
        $currentTime = strtotime($date);
        
        if ($currentTime < $todayMidnight) {
            return false;
        } else {
            return true;
        }
    }
}