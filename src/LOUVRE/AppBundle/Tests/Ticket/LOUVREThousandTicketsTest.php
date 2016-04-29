<?php

namespace LOUVRE\AppBundle\Ticket;

use LOUVRE\AppBundle\Entity\Command;
use LOUVRE\AppBundle\Ticket;
use Doctrine\Common\Collections\ArrayCollection;

class LOUVREThousandTicketsTest extends \PHPUnit_Framework_TestCase
{
    public function testIsThousand()
    {
        $louvreThousandTickets = new LOUVREThousandTickets();
        $command =  $this->getMock('LOUVRE\AppBundle\Entity\Command');
        $command->expects($this->any()) // s'applique partout ou il est utilisé
            ->method('getQuantity')
            ->will($this->returnValue(1003));

        $TotalTickets = 5;

        $collection = new ArrayCollection(array($command));

        $this->assertEquals(true, $louvreThousandTickets->isThousandTickets($collection, $TotalTickets));
    }
    
    public function testIsNotThousand()
    {
        $command =  $this->getMock('LOUVRE\AppBundle\Entity\Command');
        $command->expects($this->any())
            ->method('getQuantity')
            ->will($this->returnValue(200));
        $louvreThousandTickets = new LOUVREThousandTickets();

        $TotalTickets = 4;

        $collection = new ArrayCollection(array($command));
        
        $this->assertEquals(false, $louvreThousandTickets->isThousandTickets($collection, $TotalTickets));
    }
    
}
