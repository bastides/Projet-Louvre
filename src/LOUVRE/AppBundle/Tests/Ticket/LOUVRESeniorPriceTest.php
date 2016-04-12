<?php

namespace LOUVRE\AppBundle\Ticket;

use LOUVRE\AppBundle\Ticket;


class LOUVRESeniorPriceTest extends \PHPUnit_Framework_TestCase
{
    public function testIsSenior()
    {
        $louvreSeniorPrice = new LOUVRESeniorPrice();
        $date = new \DateTime('1955-07-21');
        
        $this->assertEquals(true, $louvreSeniorPrice->isSenior($date));
    }
    
    public function testIsNotSenior()
    {
        $louvreSeniorPrice = new LOUVRESeniorPrice();
        $date = new \DateTime('1957-01-21');
        
        $this->assertEquals(false, $louvreSeniorPrice->isSenior($date));
    }
    
}
