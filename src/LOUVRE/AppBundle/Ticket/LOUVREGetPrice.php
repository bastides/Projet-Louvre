<?php

namespace LOUVRE\AppBundle\Ticket;

class LOUVREGetPrice
{
    // Choisir le prix en fonction de la date de naissance

    private $toddlerPrice;
    private $childPrice;
    private $seniorPrice;


    public function __construct(LOUVREToddlerPrice $toddlerPrice, LOUVREChildPrice $childPrice, LOUVRESeniorPrice $seniorPrice)
    {
        $this->toddlerPrice = $toddlerPrice;
        $this->childPrice  = $childPrice;
        $this->seniorPrice = $seniorPrice;
    }

    public function isPrice($date)
    {
        if ($this->toddlerPrice->isToddler($date) === true) {
            return 0;
        } elseif ($this->childPrice->isChild($date) === true) {
            return 8;
        } elseif ($this->seniorPrice->isSenior($date) === true) {
            return 12;
        } else {
            return 16;
        }
    }
}