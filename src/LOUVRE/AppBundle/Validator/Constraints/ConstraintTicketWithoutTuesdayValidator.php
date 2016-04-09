<?php

namespace LOUVRE\AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ConstraintTicketWithoutTuesdayValidator extends ConstraintValidator
{
    // Renvoie false si le billet est acheter pour un mardi
    public function validate($dateTime, Constraint $constraint)
    {
        $timestamp = $dateTime->getTimestamp();
        $date = strftime('%A %d %B', $timestamp);
        $tuesday = explode(" ", $date);

        if ($tuesday[0] === "Tuesday") {
            $this->context->addViolation($constraint->message);
        }
    }
}