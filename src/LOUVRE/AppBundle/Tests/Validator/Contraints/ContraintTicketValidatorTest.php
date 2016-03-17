<?php

namespace LOUVRE\AppBundle\Validator\Contraints;

use LOUVRE\AppBundle\Validator\Contraints;


class ContraintTicketValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testValidTicket()
    {
        $contraintTicketValidator = new ContraintTicketValidator();
        $timestamp = strtotime('today midnight') + 1;
        $date = date("Y-m-d H:i:s", $timestamp);
        
        $this->assertEquals(true, $contraintTicketValidator->validate($date, new ContraintTicket));
    }
    
    public function testNotValidTicket()
    {
        $contraintTicketValidator = new ContraintTicketValidator();
        $timestamp = strtotime('today midnight') - 1;
        $date = date("Y-m-d H:i:s", $timestamp);
        
        $this->assertEquals(false, $contraintTicketValidator->validate($date, new ContraintTicket));
    }
}
