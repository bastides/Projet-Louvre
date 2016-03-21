<?php

namespace LOUVRE\AppBundle\Rate;

use LOUVRE\AppBundle\Rate;


class LOUVREChildRateTest extends \PHPUnit_Framework_TestCase
{
    public function testIsChild()
    {
        $louvreChildRate = new LOUVREChildRate();
        $date = '2008-07-21 13:55:33';
        
        $this->assertEquals(true, $louvreChildRate->isChild($date));
    }
    
    public function testIsNotChild()
    {
        $louvreChildRate = new LOUVREChildRate();
        $date1 = '2013-07-21 13:55:33';
        $date2 = '2002-07-21 13:55:33';
        
        $this->assertEquals(false, $louvreChildRate->isChild($date1));
        $this->assertEquals(false, $louvreChildRate->isChild($date2));
    }
    
}
