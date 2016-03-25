<?php

namespace LOUVRE\AppBundle\Validator\Contraints;

use LOUVRE\AppBundle\Validator\Contraints;


class ContraintTicketWithoutHolidayTest extends \PHPUnit_Framework_TestCase
{
    public function testWithOutHoliday()
    {
        $contraintTicketWithoutHolidayValidator = new ContraintTicketWithoutHolidayValidator();
        $date = '15/07/2016'; 
        
        $this->assertEquals(true, $contraintTicketWithoutHolidayValidator->validate($date, new ContraintTicketWithoutHoliday));
    }
    
    public function testWithHoliday()
    {
        $contraintTicketWithoutHolidayValidator = new ContraintTicketWithoutHolidayValidator();
        $date1 = '01/05/2016'; 
        $date2 = '01/11/2016'; 
        $date3 = '25/12/2016'; 
        
        $this->assertEquals(false, $contraintTicketWithoutHolidayValidator->validate($date1, new ContraintTicketWithoutHoliday));
        $this->assertEquals(false, $contraintTicketWithoutHolidayValidator->validate($date2, new ContraintTicketWithoutHoliday));
        $this->assertEquals(false, $contraintTicketWithoutHolidayValidator->validate($date3, new ContraintTicketWithoutHoliday));
    }
}
