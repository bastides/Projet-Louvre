<?php

namespace LOUVRE\AppBundle\Ticket;

use LOUVRE\AppBundle\Ticket;


class LOUVREToddlerPriceTest extends \PHPUnit_Framework_TestCase
{
    public function testIsToddler()
    {
        $louvreToddlerPrice = new LOUVREToddlerPrice();
        $date = new \DateTime('2012-07-21');
        
        $this->assertEquals(true, $louvreToddlerPrice->isToddler($date));
    }
    
    public function testIsNotToddler()
    {
        $louvreToddlerPrice = new LOUVREToddlerPrice();
        $date = new \DateTime('2011-01-01');
        
        $this->assertEquals(false, $louvreToddlerPrice->isToddler($date));
    }
    
}
