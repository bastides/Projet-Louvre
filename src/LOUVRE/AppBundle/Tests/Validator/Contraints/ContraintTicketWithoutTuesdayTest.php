<?php

namespace LOUVRE\AppBundle\Validator\Contraints;

use LOUVRE\AppBundle\Validator\Contraints;


class ContraintTicketWithoutTuesdayTest extends \PHPUnit_Framework_TestCase
{
    public function testWithOutThuesday()
    {
        $contraintTicketWithoutTuesdayValidator = new ContraintTicketWithoutTuesdayValidator();
        $date = '17/03/2016'; 
        
        $this->assertEquals(true, $contraintTicketWithoutTuesdayValidator->validate($date, new ContraintTicketWithoutTuesday));
    }
    
    public function testWithThuesday()
    {
        $contraintTicketWithoutTuesdayValidator = new ContraintTicketWithoutTuesdayValidator();
        $date = '15/03/2016'; 
        
        $this->assertEquals(false, $contraintTicketWithoutTuesdayValidator->validate($date, new ContraintTicketWithoutTuesday));
    }
}
