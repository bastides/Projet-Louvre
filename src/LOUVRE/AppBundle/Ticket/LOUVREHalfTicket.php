<?php

namespace LOUVRE\AppBundle\Ticket;

class LOUVREHalfTicket
{
    // Renvoie true si le ticket est acheté après 14h le jour même
    public function isHalfTicket(\DateTime $dateTime, \DateTime $bookingDay)
    { 
        $todayMidnight = strtotime('today midnight');
        $today14h = $todayMidnight + (60 * 60 * 14);
        
        $currentTime = $dateTime->getTimestamp();

        $date = $dateTime->format('Y-m-d');
        $bookingDate = $bookingDay->format('Y-m-d');

        if ($bookingDate == $date) {
            if ($currentTime > $today14h) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }
}