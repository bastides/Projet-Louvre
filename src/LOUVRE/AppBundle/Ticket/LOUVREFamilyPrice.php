<?php

namespace LOUVRE\AppBundle\Ticket;

class LOUVREFamilyPrice
{
    private $lastnames = [];
    private $adult = [];
    private $children = [];

    private $childPrice;

    public function __construct(LOUVREChildPrice $childPrice)
    {
        $this->childPrice  = $childPrice;
    }

    // Renvoie true si éligible au tarif famille
    public function isFamily($listTickets)
    {
        foreach ($listTickets as $ticket) {
            $lastname = $ticket->getLastname();
            array_push($this->lastnames, $lastname);
            $birthdate = $ticket->getBirthDate();
            
            if ($this->childPrice->isChild($birthdate) === true) {
                array_push($this->children, $birthdate);
            } else {
                array_push($this->adult, $birthdate);
            }
        }

        // Renvoie 1 si il y a un unique nom dans le tableau
        $uniqueLastname = count(array_unique($this->lastnames));

        $totalAdult = count($this->adult);
        $totalChildren = count($this->children);

        if ($uniqueLastname === 1 && $totalAdult === 2 && $totalChildren === 2) {
            return true;
        } else {
            return false;
        }
    }
}