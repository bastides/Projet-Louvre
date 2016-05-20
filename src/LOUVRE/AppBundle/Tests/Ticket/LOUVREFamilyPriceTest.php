<?php

namespace LOUVRE\AppBundle\Ticket;

use LOUVRE\AppBundle\Ticket;
use Doctrine\Common\Collections\ArrayCollection;

class LOUVREFamilyPriceTest extends \PHPUnit_Framework_TestCase
{
    private $lastnames = [];
    private $adult = [];
    private $children = [];

    private $childPrice;

    public function __construct()
    {
        $this->childPrice  = new LOUVREChildPrice();
    }

    public function testIsFamily()
    {
        $louvreFamilyPrice = new LOUVREFamilyPrice($this->childPrice);
        $adultTicket =  $this->getMock('LOUVRE\AppBundle\Entity\Ticket');
        $adultTicket->expects($this->any())
            ->method('getLastname')->will($this->returnValue('MARTIN'));
        $adultTicket->expects($this->any())
            ->method('getBirthDate')->will($this->returnValue(new \DateTime('1970-01-01')));

        $childTicket = $this->getMock('LOUVRE\AppBundle\Entity\Ticket');
        $childTicket->expects($this->any())
            ->method('getLastname')->will($this->returnValue('MARTIN'));
        $childTicket->expects($this->any())
            ->method('getBirthDate')->will($this->returnValue(new \DateTime('2007-01-01')));

        $listTickets = new ArrayCollection(array($adultTicket, $adultTicket, $childTicket, $childTicket));

        $this->assertEquals(true, $louvreFamilyPrice->isFamily($listTickets));
    }

    public function testIsNotFamily()
    {
        $louvreFamilyPrice = new LOUVREFamilyPrice($this->childPrice);
        $adultTicket =  $this->getMock('LOUVRE\AppBundle\Entity\Ticket');
        $adultTicket->expects($this->any())
            ->method('getLastname')->will($this->returnValue('MARTIN'));
        $adultTicket->expects($this->any())
            ->method('getBirthDate')->will($this->returnValue(new \DateTime('1970-01-01')));

        $childTicket = $this->getMock('LOUVRE\AppBundle\Entity\Ticket');
        $childTicket->expects($this->any())
            ->method('getLastname')->will($this->returnValue('MART'));
        $childTicket->expects($this->any())
            ->method('getBirthDate')->will($this->returnValue(new \DateTime('2007-01-01')));

        $listTickets = new ArrayCollection(array($adultTicket, $adultTicket, $childTicket, $childTicket));

        $this->assertEquals(false, $louvreFamilyPrice->isFamily($listTickets));
    }
}
