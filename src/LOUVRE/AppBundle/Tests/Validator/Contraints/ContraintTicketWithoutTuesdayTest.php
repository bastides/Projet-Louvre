<?php

namespace LOUVRE\AppBundle\Validator\Contraints;

use LOUVRE\AppBundle\Validator\Contraints;


class ContraintTicketWithoutTuesdayTest extends \PHPUnit_Framework_TestCase
{
    public function testWithOutThuesday()
    {
        $contraintTicketWithoutTuesdayValidator = new ContraintTicketWithoutTuesdayValidator();
        $date = '2016-03-15 13:55:33'; 
        
        $this->assertEquals(false, $contraintTicketWithoutTuesdayValidator->validate($date, new ContraintTicketWithoutTuesday));
    }
    
    public function testWithThuesday()
    {
        $contraintTicketWithoutTuesdayValidator = new ContraintTicketWithoutTuesdayValidator();
        $date = '2016-03-17 13:55:33'; 
        
        $this->assertEquals(true, $contraintTicketWithoutTuesdayValidator->validate($date, new ContraintTicketWithoutTuesday));
    }
}
