<?php

namespace LOUVRE\AppBundle\Ticket;

class LOUVRETicketsName
{
    // Choisir le nom du billet en fonction de la date de naissance

    private $toddlerPrice;
    private $childPrice;
    private $seniorPrice;


    public function __construct(LOUVREToddlerPrice $toddlerPrice, LOUVREChildPrice $childPrice, LOUVRESeniorPrice $seniorPrice)
    {
        $this->toddlerPrice = $toddlerPrice;
        $this->childPrice  = $childPrice;
        $this->seniorPrice = $seniorPrice;
    }

    public function isName($date)
    {
        if ($this->toddlerPrice->isToddler($date) === true) {
            return 'Gratuit';
        } elseif ($this->childPrice->isChild($date) === true) {
            return 'Billet enfant';
        } elseif ($this->seniorPrice->isSenior($date) === true) {
            return 'Billet sénior';
        } else {
            return 'Billet normal';
        }
    }
}