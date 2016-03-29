<?php

namespace LOUVRE\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use LOUVRE\AppBundle\Entity\Ticket;
use LOUVRE\AppBundle\Entity\OrderTickets;
use LOUVRE\AppBundle\Entity\Visitor;
use LOUVRE\AppBundle\Form\TicketType;
use LOUVRE\AppBundle\Form\OrderTicketsType;
use LOUVRE\AppBundle\Form\VisitorType;

class AppController extends Controller
{    
    public function homeAction()
    {
        return $this->render('LOUVREAppBundle:App:home.html.twig');
    }
    
    public function orderAction(Request $request) 
    {
        $ticket = new Ticket();
        $formT = $this->get('form.factory')->create(TicketType::class, $ticket);
        
        if ($formT->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($ticket);            
            $em->flush();
            
            // Récupère l'id du ticket venant d'être créé
            $idOrder = $ticket->getOrderTickets()->getId();
            // Appel du service pour générer un numéro de commande
            $getOrderNumber = $this->container->get('louvre_app.ordernumber');
            // Généation du numéro de commande
            $orderNumber = $getOrderNumber->generateNumber($idOrder);
            // Récupère l'entité OrderTickets
            $repository = $this->getDoctrine()->getManager()->getRepository('LOUVREAppBundle:OrderTickets');
            // Enregistrement du numéro de commande
            $orderTickets = $repository->find($idOrder);
            $orderTickets->setOrderNumber($orderNumber);
            $em->persist($orderTickets);            
            $em->flush();
            
            return $this->redirectToRoute('louvre_app_ordertickets', array(
                'orderNumber' => $orderNumber));
        }
        
        return $this->render('LOUVREAppBundle:App:order.html.twig', array(
            'formT' => $formT->createView()
        ));
    }
    
    public function orderTicketsAction(Request $request) 
    {
        return $this->render('LOUVREAppBundle:App:orderTickets.html.twig');
    }
}
