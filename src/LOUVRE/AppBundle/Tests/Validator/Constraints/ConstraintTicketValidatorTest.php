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

    public function testValidTicketNoDatetime()
    {
        $date = '2019-06-20 01:25:25';

        $this->validator->validate($date, new ConstraintTicket);
        $this->assertNoViolation();
    }
    
    public function testNotValidTicket()
    {
        $timestamp = strtotime('today midnight') - 1;
        $date = new \DateTime('@' . $timestamp);
        
        $this->validator->validate($date, new ConstraintTicket);
        $this->buildViolation('Vous ne pouvez pas commander de billet sur une date antérieur.');
    }
    
    protected function createValidator()
    {
        return new ConstraintTicketValidator();
    }
}
