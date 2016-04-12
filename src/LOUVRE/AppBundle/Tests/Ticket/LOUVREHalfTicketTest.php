<?php

namespace LOUVRE\AppBundle\Ticket;

use LOUVRE\AppBundle\Ticket;


class LOUVREHalfTicketTest extends \PHPUnit_Framework_TestCase
{
    public function testIsHalfTicket()
    {
        $louvreHalfTicket = new LouvreHalfTicket();

        date_default_timezone_set('Europe/Paris');
        $dateTime = new \DateTime('today 14:00:01');
        $bookingDay = new \DateTime('today');
        
        $this->assertEquals(true, $louvreHalfTicket->isHalfTicket($dateTime, $bookingDay));
    }
    
    public function testIsNotHalfTicket()
    {
        $louvreHalfTicket = new LouvreHalfTicket();

        date_default_timezone_set('Europe/Paris');
        $dateTime = new \DateTime('today 13:59:59');
        $bookingDay = new \DateTime('2017-12-01');

        $this->assertEquals(false, $louvreHalfTicket->isHalfTicket($dateTime, $bookingDay));
    }

    public function testIsNotHalfTicketWithSameDay()
    {
        $louvreHalfTicket = new LouvreHalfTicket();

        date_default_timezone_set('Europe/Paris');
        $dateTime = new \DateTime('today 13:59:59');
        $bookingDay = new \DateTime('today');

        $this->assertEquals(false, $louvreHalfTicket->isHalfTicket($dateTime, $bookingDay));
    }
}
