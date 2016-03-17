<?php

namespace LOUVRE\AppBundle\Validator\Contraints;

use LOUVRE\AppBundle\Validator\Contraints;


class ContraintHalfTicketValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testValidDayTicket()
    {
        $contraintHalfTicketValidator = new ContraintHalfTicketValidator();
        $timestamp = strtotime('today midnight') + (60 * 60 * 14 - 1);
        $date = date("Y-m-d H:i:s", $timestamp);
        
        $this->assertEquals(true, $contraintHalfTicketValidator->validate($date, new ContraintHalfTicket));
    }
    
    public function testNotValidDayTicket()
    {
        $contraintHalfTicketValidator = new ContraintHalfTicketValidator();
        $timestamp = strtotime('today midnight') + (60 * 60 * 14 + 1);
        $date = date("Y-m-d H:i:s", $timestamp);
        
        $this->assertEquals(false, $contraintHalfTicketValidator->validate($date, new ContraintHalfTicket));
    }
    
}
