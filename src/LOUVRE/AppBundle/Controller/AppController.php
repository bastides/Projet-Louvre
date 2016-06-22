<?php

namespace LOUVRE\AppBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Acl\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use LOUVRE\AppBundle\Entity\Command;
use LOUVRE\AppBundle\Form\CommandType;
use LOUVRE\AppBundle\Entity\Ticket;
use Doctrine\ORM\Cache\Persister\Collection;

class AppController extends Controller
{    
    public function homeAction()
    {
        return $this->render('LOUVREAppBundle:App:home.html.twig');
    }
    
    public function commandAction(Request $request) 
    {
        $em = $this->getDoctrine()->getManager();
        $command = new Command();
        $formC = $this->get('form.factory')->create(CommandType::class, $command);
        
        if ($formC->handleRequest($request)->isValid()) {

            // ---------- LIMITATION DE 1000 BILLETS POUR UNE DATE ----------
            $getThousandTickets = $this->container->get('louvre_app.thousand');
            $getBookingDay = $formC->get('bookingDay')->getData();
            $getQuantity = $formC->get('quantity')->getData();

            // ---------- EMPECHER DE POUVOIR COMMANDER UN BILLET JOURNEE APRES 14H LE JOUR MEME ----------
            $getHalfTicket = $this->container->get('louvre_app.half');
            $getTicketType = $formC->get('ticketType')->getData();
            $date = new \DateTime();

            $listCommands = $em->getRepository('LOUVREAppBundle:Command')->findBy(array('bookingDay' => $getBookingDay));

            if ($getThousandTickets->isThousandTickets($listCommands, $getQuantity) === true) {
                $this->get('session')->getFlashBag()->add('info', 'Le musée est complet pour cette date !');
                return $this->redirectToRoute('louvre_app_command');
            } elseif ($getTicketType === 'Journée' && $getHalfTicket->isHalfTicket($date, $getBookingDay) === true) {
                $this->get('session')->getFlashBag()->add('info', 'Vous ne pouvez pas acheter un billet journée après 14h pour cette date !');
                return $this->redirectToRoute('louvre_app_command');
            }

            // ---------- GENERATION DU NUMERO DE COMMNDE ----------
            $getBookingCode = $this->container->get('louvre_app.bookingcode');
            $bookingCode = $getBookingCode->generateCode();
            $command->setBookingCode($bookingCode);
            $em = $this->getDoctrine()->getManager();
            $em->persist($command);
            // ---------- CREATION ET STOCKAGE DES BILLETS DANS L'ARRYCOLLECTION ----------
            for ($i =  0; $i < $getQuantity; $i++) {
                $ticket = new Ticket();
                $ticket->setCommand($command);
                $em->persist($ticket);
                $command->addTicket($ticket);
            }
            $em->flush();
            
            return $this->redirectToRoute('louvre_app_command_tickets', array(
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
        $currentCommand = $em->getRepository('LOUVREAppBundle:Command')
            ->findOneBy(array('bookingCode' => $bookingCode));

        if (null === $currentCommand) {
            throw new Exception("Cette commande n'existe pas !");
        }
        
        $formC = $this->get('form.factory')->create(CommandType::class, $currentCommand);
        if ($formC->handleRequest($request)->isValid()) {
            $em->persist($currentCommand);
            $em->flush();

            return $this->redirectToRoute('louvre_app_summary', array(
                'bookingCode' => $bookingCode
            ));
        }
        
        return $this->render('LOUVREAppBundle:App:commandTickets.html.twig', array(
            'formC' => $formC->createView()
        ));
    }

    public function summaryAction(Request $request, $bookingCode)
    {
        $em = $this->getDoctrine()->getManager();
        $currentCommand = $em->getRepository('LOUVREAppBundle:Command')->findOneBy(array('bookingCode' => $bookingCode));
        if (!$currentCommand) { throw new Exception("Cette commande n'existe pas !"); }
        $listTickets = $em->getRepository('LOUVREAppBundle:Ticket')
            ->findBy(array('command' => $currentCommand));

        // ---------- GENERATION DES TARIFS ET NOMS DES BILLETS ----------
        $getPrice = $this->container->get('louvre_app.getprice');
        $getFamily = $this->container->get('louvre_app.family');
        $getName = $this->container->get('louvre_app.getname');

        // Détermination du prix des billets
        if ($currentCommand->getQuantity() === 4 && $getFamily->isFamily($listTickets) === true) {
            foreach ($listTickets as $ticket) {
                $ticket->setPrice(8.75);
                $ticket->setTicketname('Billet famille');
                $em->persist($ticket);
            }
        } else {
            foreach ($listTickets as $ticket) {
                $date = $ticket->getBirthDate();
                $ticket->setPrice($getPrice->isPrice($date));
                $ticket->setTicketname($getName->isName($date));
                if ($ticket->getReducedPrice() === true) {
                    $ticket->setPrice(10);
                    $ticket->setTicketname('Billet réduit');
                }
                $em->persist($ticket);
            }
        }

        // Calcul du montant total de tout les billets
        $currentCommand->setTotalprice($this->total($listTickets));
        $em->persist($currentCommand);
        $em->flush();

        return $this->render('LOUVREAppBundle:App:summary.html.twig', array(
            'command' => $currentCommand,
            'listTickets' => $listTickets
        ));
    }

    public function afterPaymentAction()
    {
        return $this->render('LOUVREAppBundle:App:afterPayment.html.twig');
    }

    // Fonction de calcul du total de la commande
    public function total(Array $listTickets) {
        $totalPrice = 0;
        foreach ($listTickets as $ticket) {
            $totalPrice += $ticket->getPrice();
        }
        return $totalPrice;
    }
    
}
