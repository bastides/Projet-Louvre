<?php

namespace LOUVRE\AppBundle\Ticket;

use LOUVRE\AppBundle\Ticket;


class LOUVREChildPriceTest extends \PHPUnit_Framework_TestCase
{
    public function testIsChild()
    {
        $louvreChildPrice = new LOUVREChildPrice();
        $date = new \DateTime('2008-07-21');
        
        $this->assertEquals(true, $louvreChildPrice->isChild($date));
    }
    
    public function testIsNotChild()
    {
        $louvreChildPrice = new LOUVREChildPrice();
        $date1 = new \DateTime('2013-07-21');
        $date2 = new \DateTime('2002-07-21');
        
        $this->assertEquals(false, $louvreChildPrice->isChild($date1));
        $this->assertEquals(false, $louvreChildPrice->isChild($date2));
    }
    
}
