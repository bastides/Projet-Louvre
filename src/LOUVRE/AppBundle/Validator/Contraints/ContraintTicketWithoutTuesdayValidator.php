<?php

namespace LOUVRE\AppBundle\Validator\Contraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ContraintTicketWithoutTuesdayValidator extends ConstraintValidator
{
    // Renvoie false si le billet est acheter pour un mardi
    public function validate($dateInit, Constraint $constraint)
    {
        $dateTransform = strftime('%Y-%m-%d', strtotime(str_replace("/", "-", $dateInit)));
        $date = strftime('%A %d %B', strtotime($dateTransform));
        $tuesday = explode(" ", $date);

        if ($tuesday[0] === "Tuesday") {
            return false;
        } else {
            return true;
        }
    }
}