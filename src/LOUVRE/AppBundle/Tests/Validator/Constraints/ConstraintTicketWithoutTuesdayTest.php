<?php

namespace LOUVRE\AppBundle\Validator\Constraints;

use LOUVRE\AppBundle\Validator\Constraints;
use Symfony\Component\Validator\Tests\Constraints\AbstractConstraintValidatorTest;


class ConstraintTicketWithoutTuesdayTest extends AbstractConstraintValidatorTest
{
    public function testWithOutThuesday()
    {
        $date = new \DateTime('2016-03-17');
        
        $this->validator->validate($date, new ConstraintTicketWithoutTuesday);
        $this->assertNoViolation();
    }
    
    public function testWithThuesday()
    {
        $date = new \DateTime('2016-03-15');
        
        $this->validator->validate($date, new ConstraintTicketWithoutTuesday);
        $this->buildViolation('Vous ne pouvez pas commander de billet pour un mardi.');
    }
    
    protected function createValidator()
    {
        return new ConstraintTicketWithoutTuesdayValidator();
    }
}
