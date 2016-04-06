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
    
    public function commandTicketsAction(Request $request, $bookingCode) 
    {
        $em = $this->getDoctrine()->getManager();
        
        // Récupération de la commande en cours
        $currentCommand = $em->getRepository('LOUVREAppBundle:Command')
            ->findOneBy(array('bookingCode' => $bookingCode));
        
        // Récupération du nombre de billets
        $quantity = $currentCommand->getQuantity();
            
        // Création et stockage des billets dans l'arrayCollection
        for ($i =  0; $i < $quantity; $i++) {
            $ticket = new Ticket();
            $ticket->setCommand($currentCommand);
            $currentCommand->addTicket($ticket);
        }
        
        if (null === $currentCommand) {
            throw new Exception("Cette commande n'existe pas !");
        }
        
        // Récupération de la liste des billets
        $listTickets = $currentCommand->getTickets();
        
        $formC = $this->get('form.factory')->create(CommandType::class, $currentCommand);
        
        if ($formC->handleRequest($request)->isValid()) {
            
            return $this->redirectToRoute('louvre_app_home');
        }
        
        return $this->render('LOUVREAppBundle:App:commandTickets.html.twig', array(
            'formC' => $formC->createView()
        ));
    }
}
