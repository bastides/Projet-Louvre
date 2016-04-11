<?php

namespace LOUVRE\AppBundle\Ticket;

use LOUVRE\AppBundle\Ticket;


class LOUVREChildPriceTest extends \PHPUnit_Framework_TestCase
{
    public function testIsChild()
    {
        $louvreChildPrice = new LOUVREChildPrice();
        $date = '2008-07-21 13:55:33';
        
        $this->assertEquals(true, $louvreChildPrice->isChild($date));
    }
    
    public function testIsNotChild()
    {
        $louvreChildPrice = new LOUVREChildPrice();
        $date1 = '2013-07-21 13:55:33';
        $date2 = '2002-07-21 13:55:33';
        
        $this->assertEquals(false, $louvreChildPrice->isChild($date1));
        $this->assertEquals(false, $louvreChildPrice->isChild($date2));
    }
    
}
