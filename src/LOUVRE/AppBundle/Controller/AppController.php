<?php

namespace LOUVRE\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use LOUVRE\AppBundle\Entity\Ticket;
use LOUVRE\AppBundle\Entity\TotalOrder;
use LOUVRE\AppBundle\Entity\TotalOrderTicket;
use LOUVRE\AppBundle\Entity\Visitor;
use LOUVRE\AppBundle\Form\TicketType;
use LOUVRE\AppBundle\Form\TotalOrderType;
use LOUVRE\AppBundle\Form\TotalOrderTicketType;
use LOUVRE\AppBundle\Form\VisitorType;

class AppController extends Controller
{
    public function homeAction()
    {
        return $this->render('LOUVREAppBundle:App:home.html.twig');
    }
    
    public function orderAction(Request $request) 
    {
        $totalOrderTicket = new TotalOrderTicket();
        $formTOT = $this->get('form.factory')->create(TotalOrderTicketType::class, $totalOrderTicket);
        
        if ($formTOT->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($totalOrderTicket);
            $em->flush();

            return $this->redirectToRoute('louvre_app_order');
        }
        
        return $this->render('LOUVREAppBundle:App:order.html.twig', array(
            'formTOT' => $formTOT->createView()
        ));
    }
}
