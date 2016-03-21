<?php

namespace LOUVRE\AppBundle\Ticket;

use LOUVRE\AppBundle\Ticket;


class LOUVREThousandTicketsTest extends \PHPUnit_Framework_TestCase
{
    public function testIsThousand()
    {
        $louvreThousandTickets = new LOUVREThousandTickets();
        $TotalTickets = 1001;
        
        $this->assertEquals(true, $louvreThousandTickets->isThousandTickets($TotalTickets));
    }
    
    public function testIsNotThousand()
    {
        $louvreThousandTickets = new LOUVREThousandTickets();
        $TotalTickets = 851;
        
        $this->assertEquals(false, $louvreThousandTickets->isThousandTickets($TotalTickets));
    }
    
}
