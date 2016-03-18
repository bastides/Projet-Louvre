<?php

namespace LOUVRE\AppBundle\Validator\Contraints;

use LOUVRE\AppBundle\Validator\Contraints;


class ContraintTicketWithoutHolidayTest extends \PHPUnit_Framework_TestCase
{
    public function testWithOutHoliday()
    {
        $contraintTicketWithoutHolidayValidator = new ContraintTicketWithoutHolidayValidator();
        $date = '2016-07-15 13:55:33'; 
        
        $this->assertEquals(true, $contraintTicketWithoutHolidayValidator->validate($date, new ContraintTicketWithoutHoliday));
    }
    
    public function testWithHoliday()
    {
        $contraintTicketWithoutHolidayValidator = new ContraintTicketWithoutHolidayValidator();
        $date1 = '2016-05-01 13:55:33'; 
        $date2 = '2016-11-01 13:55:33'; 
        $date3 = '2016-12-25 13:55:33'; 
        
        $this->assertEquals(false, $contraintTicketWithoutHolidayValidator->validate($date1, new ContraintTicketWithoutHoliday));
        $this->assertEquals(false, $contraintTicketWithoutHolidayValidator->validate($date2, new ContraintTicketWithoutHoliday));
        $this->assertEquals(false, $contraintTicketWithoutHolidayValidator->validate($date3, new ContraintTicketWithoutHoliday));
    }
}
