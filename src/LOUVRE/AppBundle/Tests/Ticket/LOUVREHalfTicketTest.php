<?php

namespace LOUVRE\AppBundle\Ticket;

use LOUVRE\AppBundle\Ticket;


class LOUVREHalfTicketTest extends \PHPUnit_Framework_TestCase
{
    public function testHalfTicket()
    {
        $louvreHalfTicket = new LouvreHalfTicket();
        $timestamp = strtotime('today midnight') + (60 * 60 * 14 - 1);
        $date = date("Y-m-d H:i:s", $timestamp);
        
        $this->assertEquals(true, $louvreHalfTicket->isHalfTicket($date));
    }
    
    public function testIsNotHalfTicket()
    {
        $louvreHalfTicket = new LouvreHalfTicket();
        $timestamp = strtotime('today midnight') + (60 * 60 * 14 + 1);
        $date = date("Y-m-d H:i:s", $timestamp);
        
        $this->assertEquals(false, $louvreHalfTicket->isHalfTicket($date));
    }
    
}
