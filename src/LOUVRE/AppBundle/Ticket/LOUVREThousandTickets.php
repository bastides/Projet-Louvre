<?php

namespace LOUVRE\AppBundle\Ticket;


class LOUVREThousandTickets
{
    // Renvoie true si 1000 billets ont été vendu pour cette date
    public function isThousandTickets($listCommands, $quantity)
    {
        $totalTickets = 0;

        foreach ($listCommands as $command) {
            $commandQuantity = $command->getQuantity();
            $totalTickets += $commandQuantity;
        }

        return (($totalTickets + $quantity) > 1000 );
    }
}