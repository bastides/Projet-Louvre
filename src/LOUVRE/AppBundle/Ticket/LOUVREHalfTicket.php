<?php

namespace LOUVRE\AppBundle\Ticket;

class LOUVREHalfTicket
{
    // Renvoie true si le ticket est acheté après 14h
    public function isHalfTicket($date)
    { 
        $todayMidnight = strtotime('today midnight');
        $today14h = $todayMidnight + (60 * 60 * 14);
        
        $currentTime = strtotime($date);
        
        if ($currentTime < $today14h) {
            return true;
        } else {
            return false;
        }
    }
}