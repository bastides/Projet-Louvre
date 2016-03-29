<?php

namespace LOUVRE\AppBundle\Ticket;

use LOUVRE\AppBundle\Ticket;


class LOUVRESeniorRateTest extends \PHPUnit_Framework_TestCase
{
    public function testIsSenior()
    {
        $louvreSeniorRate = new LOUVRESeniorRate();
        $date = '1955-07-21 13:55:33';
        
        $this->assertEquals(true, $louvreSeniorRate->isSenior($date));
    }
    
    public function testIsNotSenior()
    {
        $louvreSeniorRate = new LOUVRESeniorRate();
        $date = '1957-01-21 13:55:33';
        
        $this->assertEquals(false, $louvreSeniorRate->isSenior($date));
    }
    
}
