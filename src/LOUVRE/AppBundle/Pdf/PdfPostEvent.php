<?php

namespace LOUVRE\AppBundle\Pdf;

use Symfony\Component\EventDispatcher\Event;

class PdfPostEvent extends Event
{
    protected $currentCommand;
    protected $listTickets;

    public function __construct($currentCommand, $listTickets)
    {
        $this->currentCommand = $currentCommand;
        $this->listTickets = $listTickets;
    }

    public function getCommand()
    {
        return $this->currentCommand;
    }

    public function getListTickets()
    {
        return $this->listTickets;
    }
}