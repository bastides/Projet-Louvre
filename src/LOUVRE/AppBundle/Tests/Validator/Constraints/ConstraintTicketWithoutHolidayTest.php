<?php

namespace LOUVRE\AppBundle\Validator\Constraints;

use LOUVRE\AppBundle\Validator\Constraints;
use Symfony\Component\Validator\Tests\Constraints\AbstractConstraintValidatorTest;

class ConstraintTicketWithoutHolidayTest extends AbstractConstraintValidatorTest
{
    public function testWithOutHoliday()
    {
        $date = new \DateTime('2016-07-15');
        
        $this->validator->validate($date, new ConstraintTicketWithoutHoliday);
        $this->assertNoViolation();
    }
    
    public function testWithHoliday()
    {
        $date1 = new \DateTime('2016-05-01');
        $date2 = new \DateTime('2016-11-01');
        $date3 = new \DateTime('2016-12-25'); 
        
        $this->validator->validate($date1, new ConstraintTicketWithoutHoliday);
        $this->buildViolation('Vous ne pouvez pas commander de billet un jour férié.');
        $this->validator->validate($date2, new ConstraintTicketWithoutHoliday);
        $this->buildViolation('Vous ne pouvez pas commander de billet un jour férié.');
        $this->validator->validate($date3, new ConstraintTicketWithoutHoliday);
        $this->buildViolation('Vous ne pouvez pas commander de billet un jour férié.');
    }
    
    protected function createValidator()
    {
        return new ConstraintTicketWithoutHolidayValidator();
    }
}
