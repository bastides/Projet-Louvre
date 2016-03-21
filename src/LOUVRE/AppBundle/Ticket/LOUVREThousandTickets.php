<?php

namespace LOUVRE\AppBundle\Ticket;

class LOUVREThousandTickets
{
    // Renvoie true si 1000 tickets oont été vendu
    public function isThousandTickets($TotalTickets)
    { 
        if ($TotalTickets >= 1000) {
            return true;
        } else {
            return false;
        }
    }
}