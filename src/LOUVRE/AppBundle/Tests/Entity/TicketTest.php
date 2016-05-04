<?php

namespace LOUVRE\AppBundle\Entity;

use LOUVRE\AppBundle\Entity;


class TicketTest extends \PHPUnit_Framework_TestCase
{
    public function testSetLastName()
    {
        $ticket = new Ticket();
        $lastname = 'laporte';

        $ticket->setLastname($lastname);

        $this->assertEquals('LAPORTE', $ticket->getLastname());
    }

    public function testSetFirstName()
    {
        $ticket = new Ticket();
        $firstname = 'bruno';

        $ticket->setFirstname($firstname);

        $this->assertEquals('Bruno', $ticket->getFirstname());
    }

}
