<?php

namespace LOUVRE\AppBundle\Ticket;

class LOUVREToddlerRate
{
    // Renvoie true si l'enfant a moins de 4 ans
    public function isToddler($date)
    { 
        $today = strtotime('today') - (3600 * 24 * 365 * 4); 
        $toddlerBirthDay = strtotime($date);
        
        if ($today < $toddlerBirthDay) {
            return true;
        } else {
            return false;
        }
    }
}