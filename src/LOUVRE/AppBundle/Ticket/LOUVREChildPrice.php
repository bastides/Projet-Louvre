<?php

namespace LOUVRE\AppBundle\Ticket;

class LOUVREChildPrice
{
    // Renvoie true si le l'enfant a entre 4 et 12 ans
    public function isChild(\DateTime $date)
    { 
        $today12 = strtotime('today') - (3600 * 24 * 365 * 12); 
        $today4 = strtotime('today') - (3600 * 24 * 365 * 4); 
        $childBirthDay = $date->getTimestamp();

        if ($childBirthDay < $today4 && $childBirthDay > $today12) {
            return true;
        } else {
            return false;
        }
    }
}