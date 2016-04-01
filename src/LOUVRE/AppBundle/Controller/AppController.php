<?php

namespace LOUVRE\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use LOUVRE\AppBundle\Entity\Command;
use LOUVRE\AppBundle\Form\CommandType;
use LOUVRE\AppBundle\Entity\Ticket;
use LOUVRE\AppBundle\Form\TicketType;

class AppController extends Controller
{    
    public function homeAction()
    {
        return $this->render('LOUVREAppBundle:App:home.html.twig');
    }
    
    public function commandAction(Request $request) 
    {
        $command = new Command();
        $formC = $this->get('form.factory')->create(CommandType::class, $command);
        
        if ($formC->handleRequest($request)->isValid()) {
            // Appel du service pour générer un numéro de commande
            $getBookingCode = $this->container->get('louvre_app.bookingcode');
            // Généation du numéro de commande
            $bookingCode = $getBookingCode->generateCode();
            // Enregistrement du numéro de commande
            $command->setBookingCode($bookingCode);

            $em = $this->getDoctrine()->getManager();
            $em->persist($command);
            $em->flush();
            
            return $this->redirectToRoute('louvre_app_commandtickets', array(
                'bookingCode' => $bookingCode
            ));
        }
        
        return $this->render('LOUVREAppBundle:App:command.html.twig', array(
            'formC' => $formC->createView()
        ));
    }
    
    public function commandTicketsAction(Request $request, $orderNumber) 
    {            
        return $this->render('LOUVREAppBundle:App:commandTickets.html.twig');
    }
}
