<?php

namespace LOUVRE\AppBundle\Ticket;

class LOUVREHalfTicket
{
    // Renvoie true si le ticket est acheté après 14h
    public function isHalfTicket($dateTime)
    { 
        $todayMidnight = strtotime('today midnight');
        $today14h = $todayMidnight + (60 * 60 * 14);
        
        $currentTime = strtotime($dateTime);
        
        if ($currentTime < $today14h) {
            return true;
        } else {
            return false;
        }
    }
}