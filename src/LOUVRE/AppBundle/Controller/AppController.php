<?php

namespace LOUVRE\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Acl\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
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

            // ---------- LIMITATION DE 1000 BILLETS POUR UNE DATE ----------
            // Appel du service empechant la commande de 1000 billets pour le même jour
            $getThousandTickets = $this->container->get('louvre_app.thousand');
            // Récupération de la date de réservation entrée par l'utilisateur
            $getBookingDay = $formC->get('bookingDay')->getData();
            // Récupération de la quantité de billets entrée par l'utilisateur
            $getQuantity = $formC->get('quantity')->getData();

            // ---------- EMPECHER DE POUVOIR COMMANDER UN BILLET JOURNEE APRES 14H LE JOUR MEME ----------
            // Appel du service HalfTicket
            $getHalfTicket = $this->container->get('louvre_app.half');
            // Récupération du type de billet
            $getTicketType = $formC->get('ticketType')->getData();
            // Date et heure actuelle
            date_default_timezone_set('Europe/Paris');
            $date = new \DateTime();

            if ($getThousandTickets->isThousandTickets($getBookingDay, $getQuantity) === true) {
                throw new Exception("Le musée est complet pour cette date !");
            } elseif ($getTicketType === 'Journée' && $getHalfTicket->isHalfTicket($date, $getBookingDay) === true) {
                throw new Exception("Vous ne pouvez pas acheter un billet journée après 14h pour cette date !");
            }

            // ---------- GENERATION DU NUMERO DE COMMNDE ----------
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

        if (null === $currentCommand) {
            throw new Exception("Cette commande n'existe pas !");
        }

        // ---------- CREATION ET STOCKAGE DES BILLETS DANS L'ARRYCOLLECTION ----------
        // Récupération du nombre de billets
        $quantity = $currentCommand->getQuantity();
        // Création et stockage des billets dans l'arrayCollection
        for ($i =  0; $i < $quantity; $i++) {
            $ticket = new Ticket();
            $ticket->setCommand($currentCommand);
            $currentCommand->addTicket($ticket);
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

        // Récupération de la commande en cours
        $currentCommand = $em->getRepository('LOUVREAppBundle:Command')
            ->findOneBy(array('bookingCode' => $bookingCode));
        // Récupération de la liste des billets
        $listTickets = $em->getRepository('LOUVREAppBundle:Ticket')
            ->findBy(array('command' => $currentCommand));

        // ---------- GENERATION DES TARIFS ET NOMS DES BILLETS ----------
        // Appel du service pour générer le prix du billet
        $getPrice = $this->container->get('louvre_app.getprice');
        // Appel du service pour le tarif famille
        $getFamily = $this->container->get('louvre_app.family');
        // Appel du service pour le nom du billet
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
        $totalPrice = 0;
        foreach ($listTickets as $ticket) {
            $totalPrice += $ticket->getPrice();
        }
        $currentCommand->setTotalprice($totalPrice);
        $em->persist($currentCommand);
        $em->flush();

        return $this->render('LOUVREAppBundle:App:summary.html.twig', array(
            'command' => $currentCommand,
            'listTickets' => $listTickets
        ));
    }
}
