<?php

namespace LOUVRE\AppBundle\Validator\Contraints;

use LOUVRE\AppBundle\Validator\Contraints;
use Symfony\Component\Validator\Tests\Constraints\AbstractConstraintValidatorTest;


class ContraintTicketValidatorTest extends AbstractConstraintValidatorTest
{
    public function testValidTicket()
    {
        $timestamp = strtotime('today midnight') + 1;
        $date = date("Y-m-d H:i:s", $timestamp);
        
        $this->validator->validate($date, new ContraintTicket);
        $this->assertNoViolation();
    }
    
    public function testNotValidTicket()
    {
        $timestamp = strtotime('today midnight') - 1;
        $date = date("Y-m-d H:i:s", $timestamp);
        
        $this->validator->validate($date, new ContraintTicket);
        $this->assertNoViolation();
    }
    
    protected function createValidator()
    {
        return new ContraintTicketValidator();
    }
}
