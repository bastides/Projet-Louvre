<?php

namespace LOUVRE\AppBundle\Rate;

use LOUVRE\AppBundle\Rate;


class LOUVREToddlerRateTest extends \PHPUnit_Framework_TestCase
{
    public function testIsToddler()
    {
        $louvreToddlerRate = new LOUVREToddlerRate();
        $date = '2012-07-21 13:55:33';
        
        $this->assertEquals(true, $louvreToddlerRate->isToddler($date));
    }
    
    public function testIsNotToddler()
    {
        $louvreToddlerRate = new LOUVREToddlerRate();
        $date = '2011-01-01 13:55:33';
        
        $this->assertEquals(false, $louvreToddlerRate->isToddler($date));
    }
    
}
