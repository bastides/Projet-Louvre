<?php

namespace LOUVRE\AppBundle\Ticket;

use LOUVRE\AppBundle\Ticket;

class LOUVREGetPriceTest extends \PHPUnit_Framework_TestCase
{
    public function testIfPriceIsToddler()
    {
        $toddlerPrice = new LOUVREToddlerPrice();
        $childPrice = new LOUVREChildPrice();
        $seniorPrice = new LOUVRESeniorPrice();

        $date = new \DateTime('2015-07-21');

        $getPrice = new LOUVREGetPrice($toddlerPrice, $childPrice, $seniorPrice);

        $this->assertEquals(0, $getPrice->isPrice($date));
    }

    public function testIfPriceIsChild()
    {
        $toddlerPrice = new LOUVREToddlerPrice();
        $childPrice = new LOUVREChildPrice();
        $seniorPrice = new LOUVRESeniorPrice();

        $date = new \DateTime('2008-07-21');

        $getPrice = new LOUVREGetPrice($toddlerPrice, $childPrice, $seniorPrice);

        $this->assertEquals(8, $getPrice->isPrice($date));
    }

    public function testIfPriceIsSenior()
    {
        $toddlerPrice = new LOUVREToddlerPrice();
        $childPrice = new LOUVREChildPrice();
        $seniorPrice = new LOUVRESeniorPrice();

        $date = new \DateTime('1955-07-21');

        $getPrice = new LOUVREGetPrice($toddlerPrice, $childPrice, $seniorPrice);

        $this->assertEquals(12, $getPrice->isPrice($date));
    }

    public function testIfPriceIsNormal()
    {
        $toddlerPrice = new LOUVREToddlerPrice();
        $childPrice = new LOUVREChildPrice();
        $seniorPrice = new LOUVRESeniorPrice();

        $date = new \DateTime('1985-07-21');

        $getPrice = new LOUVREGetPrice($toddlerPrice, $childPrice, $seniorPrice);

        $this->assertEquals(16, $getPrice->isPrice($date));
    }

    /* public function testIfPriceIsToddle()
    {
        $toddler = $this->getMockBuilder('LOUVREToddlerPrice')->getMock()
            ->expects($this->any())->method('isToddler')->will($this->returnValue(true));
        $toddlerPrice = new LOUVREToddlerPrice($toddler);

        $child = $this->getMockBuilder('LOUVREChildPrice')->getMock()
            ->expects($this->any())->method('isChild')->will($this->returnValue(false));
        $childPrice = new LOUVREChildPrice($child);

        $senior = $this->getMockBuilder('LOUVRESeniorPrice')->getMock()
            ->expects($this->any())->method('isSenior')->will($this->returnValue(false));
        $seniorPrice = new LOUVRESeniorPrice($senior);

        $date = new \DateTime();

        $getPrice = new LOUVREGetPrice($toddlerPrice, $childPrice, $seniorPrice);

        $this->assertEquals(0, $getPrice->isPrice($date));
    }*/
}