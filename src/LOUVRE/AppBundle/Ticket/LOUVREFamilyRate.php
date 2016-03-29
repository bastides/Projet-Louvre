<?php

namespace LOUVRE\AppBundle\Ticket;

class LOUVREFamilyRate
{
    // Renvoie true si les membres de la famille portent le même nom
    public function isFamily($name1, $name2, $name3, $name4)
    { 
        if ($name1 === $name2 && $name1 === $name3 && $name1 === $name4) {
            return true;
        } else {
            return false;
        }
    }
}