<?php

namespace LOUVRE\AppBundle\Pdf;

class PdfProcessListener
{
    protected $pdfProcess;

    public function __construct(PdfProcess $pdfProcess)
    {
        $this->pdfProcess = $pdfProcess;
    }

    public function doProcess(PdfPostEvent $event)
    {
        $email = $event->getCommand()->getEmail();
        $fileName = $event->getCommand()->getBookingCode();

        // Création du PDF
        $this->pdfProcess->createPDF($event->getCommand(), $event->getListTickets(), $fileName);
        // Envoie du mail
        $this->pdfProcess->sendPDF($email, $fileName);

    }
}