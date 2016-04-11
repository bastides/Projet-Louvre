<?php

namespace LOUVRE\AppBundle\Ticket;

use LOUVRE\AppBundle\Ticket;


class LOUVREFamilyPriceTest extends \PHPUnit_Framework_TestCase
{
    public function testIsFamily()
    {
        $louvreFamilyPrice = new LOUVREFamilyPrice();
        $name1 = 'BASTIDE';
        $name2 = 'BASTIDE';
        $name3 = 'BASTIDE';
        $name4 = 'BASTIDE';
        
        $this->assertEquals(true, $louvreFamilyPrice->isFamily($name1, $name2, $name3, $name4));
    }
    
    public function testIsNotFamily()
    {
        $louvreFamilyPrice = new LOUVREFamilyPrice();
        $name1 = 'BASTIDE';
        $name2 = 'BASTIDE';
        $name3 = 'BASTIDE';
        $name4 = 'BAPTISTE';
        
        $this->assertEquals(false, $louvreFamilyPrice->isFamily($name1, $name2, $name3, $name4));
    }
    
}
