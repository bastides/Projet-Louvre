<?php

namespace LOUVRE\AppBundle\Ticket;

class LOUVRESeniorPrice
{
    // Renvoie true si le senior a plus de 60 ans
    public function isSenior(\DateTime $date)
    { 
        $today = strtotime('today') - (3600 * 24 * 365 * 60); 
        $seniorBirthDay = $date->getTimestamp();

        if ($today > $seniorBirthDay) {
            return true;
        } else {
            return false;
        }
    }
}