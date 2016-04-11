<?php

namespace LOUVRE\AppBundle\Ticket;

use LOUVRE\AppBundle\Ticket;


class LOUVRESeniorPriceTest extends \PHPUnit_Framework_TestCase
{
    public function testIsSenior()
    {
        $louvreSeniorPrice = new LOUVRESeniorPrice();
        $date = '1955-07-21 13:55:33';
        
        $this->assertEquals(true, $louvreSeniorPrice->isSenior($date));
    }
    
    public function testIsNotSenior()
    {
        $louvreSeniorPrice = new LOUVRESeniorPrice();
        $date = '1957-01-21 13:55:33';
        
        $this->assertEquals(false, $louvreSeniorPrice->isSenior($date));
    }
    
}
