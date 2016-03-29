<?php

namespace LOUVRE\AppBundle\Ticket;

class LOUVRESeniorRate
{
    // Renvoie true si le senior a plus de 60 ans
    public function isSenior($date)
    { 
        $today = strtotime('today') - (3600 * 24 * 365 * 60); 
        $seniorBirthDay = strtotime($date);

        if ($today > $seniorBirthDay) {
            return true;
        } else {
            return false;
        }
    }
}