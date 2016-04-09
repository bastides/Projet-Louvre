<?php

namespace LOUVRE\AppBundle\Validator\Constraints;

use LOUVRE\AppBundle\Validator\Constraints;
use Symfony\Component\Validator\Tests\Constraints\AbstractConstraintValidatorTest;


class ConstraintTicketValidatorTest extends AbstractConstraintValidatorTest
{
    public function testValidTicket()
    {
        $timestamp = strtotime('today midnight') + 1;
        $date = new \DateTime('@' . $timestamp);
        
        $this->validator->validate($date, new ConstraintTicket);
        $this->assertNoViolation();
    }
    
    public function testNotValidTicket()
    {
        $timestamp = strtotime('today midnight') - 1;
        $date = new \DateTime('@' . $timestamp);
        
        $this->validator->validate($date, new ConstraintTicket);
        $this->assertNoViolation();
    }
    
    protected function createValidator()
    {
        return new ConstraintTicketValidator();
    }
}
