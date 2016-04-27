<?php

namespace LOUVRE\AppBundle\Pdf;


class PdfProcess
{
    protected $mailer;
    protected $snappy;
    protected $twig;

    public function __construct(\Swift_Mailer $mailer, \Knp\Bundle\SnappyBundle\Snappy\LoggableGenerator $snappy, \Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->snappy = $snappy;
        $this->twig = $twig;
    }

    // Méthode pour envoyer le pdf à l'utilisateur
    public function sendPDF($to, $fileName)
    {
        $transport = \Swift_SmtpTransport::newInstance('127.0.0.1', 1025);

        $message = \Swift_Message::newInstance()
            ->setSubject("Vos billets pour le Louvre")
            ->setFrom('louvre@louvre.com')
            ->setTo($to)
            ->setBody("Vous trouverez en Piece-jointe vos billets au format PDF", 'text/plain', 'UTF-8')
            ->attach(\Swift_Attachment::fromPath(__DIR__.'\..\..\..\..\web\pdf\\' . $fileName . '.pdf'));

        $mailer = \Swift_Mailer::newInstance($transport);

        $mailer->send($message);

    }

    public function createPDF($currentCommand, $listTickets, $fileName)
    {
        $this->snappy->generateFromHtml(
            $this->twig->render(
                'LOUVREAppBundle:App:pdf.html.twig',
                array(
                    'command' => $currentCommand,
                    'listTickets' => $listTickets
                )
            ),
            __DIR__.'\..\..\..\..\web\pdf\\' . $fileName . '.pdf'
        );
    }
}