<?php

namespace LOUVRE\AppBundle\Ticket;

use Doctrine\ORM\EntityManagerInterface;

class LOUVREThousandTickets
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    // Renvoie true si un total de 1000 billets ont été vendu pour cette date
    public function isThousandTickets($bookingDay, $quantity)
    {
        $listCommands = $this->em->getRepository('LOUVREAppBundle:Command')->findBy(array('bookingDay' => $bookingDay));

        $totalTickets = 0;

        foreach ($listCommands as $command) {
            $commandQuantity = $command->getQuantity();
            $totalTickets += $commandQuantity;
        }

        if (($totalTickets + $quantity) > 1000 ) {
            return true;
        } else {
            return false;
        }
    }
}