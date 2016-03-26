<?php

namespace LOUVRE\AppBundle\Validator\Contraints;

use LOUVRE\AppBundle\Validator\Contraints;
use Symfony\Component\Validator\Tests\Constraints\AbstractConstraintValidatorTest;


class ContraintTicketWithoutTuesdayTest extends AbstractConstraintValidatorTest
{
    public function testWithOutThuesday()
    {
        $date = '2016-03-17'; 
        
        $this->validator->validate($date, new ContraintTicketWithoutTuesday);
        $this->assertNoViolation();
    }
    
    public function testWithThuesday()
    {
        $date = '2016-03-15'; 
        
        $this->validator->validate($date, new ContraintTicketWithoutTuesday);
        $this->assertNoViolation();
    }
    
    protected function createValidator()
    {
        return new ContraintTicketWithoutTuesdayValidator();
    }
}
