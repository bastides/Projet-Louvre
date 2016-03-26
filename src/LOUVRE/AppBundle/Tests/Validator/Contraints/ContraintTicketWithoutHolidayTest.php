<?php

namespace LOUVRE\AppBundle\Validator\Contraints;

use LOUVRE\AppBundle\Validator\Contraints;
use Symfony\Component\Validator\Tests\Constraints\AbstractConstraintValidatorTest;

class ContraintTicketWithoutHolidayTest extends AbstractConstraintValidatorTest
{
    public function testWithOutHoliday()
    {
        $date = '2016-07-15'; 
        
        $this->validator->validate($date, new ContraintTicketWithoutHoliday);
        $this->assertNoViolation();
    }
    
    public function testWithHoliday()
    {
        $date1 = '2016-05-01'; 
        $date2 = '2016-11-01'; 
        $date3 = '2016-12-25'; 
        
        $this->validator->validate($date1, new ContraintTicketWithoutHoliday);
        $this->assertNoViolation();
        $this->validator->validate($date2, new ContraintTicketWithoutHoliday);
        $this->assertNoViolation();
        $this->validator->validate($date3, new ContraintTicketWithoutHoliday);
        $this->assertNoViolation();
    }
    
    protected function createValidator()
    {
        return new ContraintTicketWithoutHolidayValidator();
    }
}
