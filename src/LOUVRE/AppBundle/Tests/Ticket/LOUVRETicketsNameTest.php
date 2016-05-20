<?php

namespace LOUVRE\AppBundle\Ticket;


use LOUVRE\AppBundle\Ticket;


class LOUVRETicketsNameTest extends \PHPUnit_Framework_TestCase
{
    private $toddlerPrice;
    private $childPrice;
    private $seniorPrice;


    public function __construct()
    {
        $this->toddlerPrice = new LOUVREToddlerPrice();
        $this->childPrice  = new LOUVREChildPrice();
        $this->seniorPrice = new LOUVRESeniorPrice();
    }

    public function testIsNameIsGratuit()
    {
        $louvreTicketsName = new LOUVRETicketsName($this->toddlerPrice, $this->childPrice, $this->seniorPrice);
        $date = new \DateTime();

        $this->assertEquals('Gratuit', $louvreTicketsName->isName($date));
    }

    public function testIsNameIsChild()
    {
        $louvreTicketsName = new LOUVRETicketsName($this->toddlerPrice, $this->childPrice, $this->seniorPrice);
        $date = new \DateTime('2007-01-01');

        $this->assertEquals('Billet enfant', $louvreTicketsName->isName($date));
    }

    public function testIsNameIsSenior()
    {
        $louvreTicketsName = new LOUVRETicketsName($this->toddlerPrice, $this->childPrice, $this->seniorPrice);
        $date = new \DateTime('1940-01-01');

        $this->assertEquals('Billet sénior', $louvreTicketsName->isName($date));
    }

    public function testIsNameIsNormal()
    {
        $louvreTicketsName = new LOUVRETicketsName($this->toddlerPrice, $this->childPrice, $this->seniorPrice);
        $date = new \DateTime('1985-01-01');

        $this->assertEquals('Billet normal', $louvreTicketsName->isName($date));
    }
}
