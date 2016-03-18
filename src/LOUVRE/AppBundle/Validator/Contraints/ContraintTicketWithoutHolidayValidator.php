<?php

namespace LOUVRE\AppBundle\Validator\Contraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ContraintTicketWithoutHolidayValidator extends ConstraintValidator
{
    // Renvoie false si le billet est acheter pour un mardi
    public function validate($dateTime, Constraint $constraint)
    {
        $holidays = ['2016-05-01', '2016-11-01', '2016-12-25'];
        $holiday = [];

        $date = strftime('%d %B', strtotime($dateTime));

        for ($i = 0; $i < count($holidays); $i++) {
            $holiday[$i] = strftime('%d %B', strtotime($holidays[$i]));
        }

        switch ($date) {
            case $holiday[0]:
                return false;
                break;
            case $holiday[1]:
                return false;
                break;
            case $holiday[2]:
                return false;
                break;
            default:
               return true;
        }
    }
}