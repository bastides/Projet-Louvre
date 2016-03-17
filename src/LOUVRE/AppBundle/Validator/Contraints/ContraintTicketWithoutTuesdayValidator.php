<?php

namespace LOUVRE\AppBundle\Validator\Contraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ContraintTicketWithoutTuesdayValidator extends ConstraintValidator
{
    // Renvoie false si le billet est acheter pour un mardi
    public function validate($dateTime, Constraint $constraint)
    {
        $date = strftime('%A %d %B', strtotime($dateTime));
        $tuesday = explode(" ", $date);

        if ($tuesday[0] === "Tuesday") {
            return false;
        } else {
            return true;
        }
    }
}