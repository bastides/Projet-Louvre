<?php

namespace LOUVRE\AppBundle\Validator\Contraints;

use LOUVRE\AppBundle\Validator\Contraints;


class ContraintTicketValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testValidTicket()
    {
        $contraintTicketValidator = new ContraintTicketValidator();
        $timestamp = strtotime('today midnight') + 1;
        $dateInit = date("Y-m-d H:i:s", $timestamp);
        $date = strftime('%d-%m-%Y', strtotime(str_replace("-", "/", $dateInit)));
        
        $this->assertEquals(true, $contraintTicketValidator->validate($date, new ContraintTicket));
    }
    
    public function testNotValidTicket()
    {
        $contraintTicketValidator = new ContraintTicketValidator();
        $timestamp = strtotime('today midnight') - 1;
        $dateInit = date("Y-m-d H:i:s", $timestamp);
        $date = strftime('%d-%m-%Y', strtotime(str_replace("-", "/", $dateInit)));
        
        $this->assertEquals(false, $contraintTicketValidator->validate($date, new ContraintTicket));
    }
}
