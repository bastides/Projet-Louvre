<?php

namespace LOUVRE\AppBundle\Ticket;

class LOUVREToddlerPrice
{
    // Renvoie true si l'enfant a moins de 4 ans
    public function isToddler(\DateTime $date)
    { 
        $today = strtotime('today') - (3600 * 24 * 365 * 4);
        $toddlerBirthDay = $date->getTimestamp();

        if ($today < $toddlerBirthDay) {
            return true;
        } else {
            return false;
        }
    }
}