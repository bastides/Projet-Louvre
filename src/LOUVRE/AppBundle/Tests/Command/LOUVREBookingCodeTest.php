<?php

namespace LOUVRE\AppBundle\Command;

use LOUVRE\AppBundle\Command;


class LOUVREBookingCodeTest extends \PHPUnit_Framework_TestCase
{
    public function testIsGenerateCode()
    {
        $louvreBookingCode = new LOUVREBookingCode();


        $this->assertRegExp('/([A-Z])(\d+)(LOUVRE)(\d+)/', $louvreBookingCode->generateCode());
    }
}
