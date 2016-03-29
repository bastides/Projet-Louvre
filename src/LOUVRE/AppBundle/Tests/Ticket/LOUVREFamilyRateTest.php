<?php

namespace LOUVRE\AppBundle\Ticket;

use LOUVRE\AppBundle\Ticket;


class LOUVREFamilyRateTest extends \PHPUnit_Framework_TestCase
{
    public function testIsFamily()
    {
        $louvreFamilyRate = new LOUVREFamilyRate();
        $name1 = 'BASTIDE';
        $name2 = 'BASTIDE';
        $name3 = 'BASTIDE';
        $name4 = 'BASTIDE';
        
        $this->assertEquals(true, $louvreFamilyRate->isFamily($name1, $name2, $name3, $name4));
    }
    
    public function testIsNotFamily()
    {
        $louvreFamilyRate = new LOUVREFamilyRate();
        $name1 = 'BASTIDE';
        $name2 = 'BASTIDE';
        $name3 = 'BASTIDE';
        $name4 = 'BAPTISTE';
        
        $this->assertEquals(false, $louvreFamilyRate->isFamily($name1, $name2, $name3, $name4));
    }
    
}
