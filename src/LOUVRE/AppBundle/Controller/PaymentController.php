<?php
// src/LOUVRE/AppBundle/Controller/PaymentController.php

namespace LOUVRE\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Payum\Core\Request\GetHumanStatus;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use LOUVRE\AppBundle\Entity\Command;
use LOUVRE\AppBundle\Entity\Ticket;
use LOUVRE\AppBundle\Entity\PaymentDetails;
use Payum\Core\Security\SensitiveValue;
use LOUVRE\AppBundle\Pdf\PdfEvents;
use LOUVRE\AppBundle\Pdf\PdfPostEvent;

class PaymentController extends Controller
{
    public function preparePaypalExpressCheckoutPaymentAction($bookingCode)
    {
        $em = $this->getDoctrine()->getManager();

        // Récupération de la commande en cours
        $currentCommand = $em->getRepository('LOUVREAppBundle:Command')
            ->findOneBy(array('bookingCode' => $bookingCode));
        // Récupération de la liste des billets
        $listTickets = $em->getRepository('LOUVREAppBundle:Ticket')
            ->findBy(array('command' => $currentCommand));

        $gatewayName = 'tickets_by_paypal';

        $storage = $this->get('payum')->getStorage('LOUVRE\AppBundle\Entity\PaymentDetails');

        /** @var \LOUVRE\AppBundle\Entity\PaymentDetails $details */
        $details = $storage->create();
        $details['PAYMENTREQUEST_0_CURRENCYCODE'] = 'EUR';
        $details['PAYMENTREQUEST_0_AMT'] = $currentCommand->getTotalprice();
        foreach ($listTickets as $i => $ticket) {
            $details['L_PAYMENTREQUEST_0_NAME' . $i] = $ticket->getTicketname();
            $details['L_PAYMENTREQUEST_0_AMT' . $i] = $ticket->getPrice();
        }
        $storage->update($details);

        $payment = $storage->find($details->getId());
        $payment->setCommand($currentCommand);
        $em->persist($payment);
        $em->flush($payment);

        $captureToken = $this->get('payum')->getTokenFactory()->createCaptureToken(
            $gatewayName,
            $details,
            'louvre_payment_done' // the route to redirect after capture;
        );

        return $this->redirect($captureToken->getTargetUrl());
    }

    public function prepareStripeJsPaymentAction($bookingCode)
    {
        $em = $this->getDoctrine()->getManager();

        // Récupération de la commande en cours
        $currentCommand = $em->getRepository('LOUVREAppBundle:Command')
            ->findOneBy(array('bookingCode' => $bookingCode));

        $amount = $currentCommand->getTotalprice() * 100;

        $gatewayName = 'tickets_by_stripe';

        $storage = $this->get('payum')->getStorage('LOUVRE\AppBundle\Entity\PaymentDetails');

        /** @var PaymentDetails $details */
        $details = $storage->create();
        $details["amount"] = $amount;
        $details["currency"] = 'EUR';
        $storage->update($details);

        $payment = $storage->find($details->getId());
        $payment->setCommand($currentCommand);
        $em->persist($payment);
        $em->flush($payment);

        $captureToken = $this->get('payum')->getTokenFactory()->createCaptureToken(
            $gatewayName,
            $details,
            'louvre_payment_done' // the route to redirect after capture;
        );

        return $this->redirect($captureToken->getTargetUrl());
    }

    public function captureDoneAction(Request $request)
    {
        $token = $this->get('payum')->getHttpRequestVerifier()->verify($request);

        $identity = $token->getDetails();
        $model = $this->get('payum')->getStorage($identity->getClass())->find($identity);

        $em = $this->getDoctrine()->getManager();
        // Récupération de l'ID de la commande
        $commandId = $model->getCommand()->getId();
        // Récupération de la commande en cours
        $currentCommand = $em->getRepository('LOUVREAppBundle:Command')
            ->find($commandId);
        // Récupération de la liste des billets
        $listTickets = $em->getRepository('LOUVREAppBundle:Ticket')
            ->findBy(array('command' => $currentCommand));

        $bookingCode = $currentCommand->getBookingCode();

        $gateway = $this->get('payum')->getGateway($token->getGatewayName());

        // you can invalidate the token. The url could not be requested any more.
        // $this->get('payum')->getHttpRequestVerifier()->invalidate($token);

        // Once you have token you can get the model from the storage directly.
        //$identity = $token->getDetails();
        //$details = $payum->getStorage($identity->getClass())->find($identity);

        // or Payum can fetch the model for you while executing a request (Preferred).
        $gateway->execute($status = new GetHumanStatus($token));
        $details = $status->getFirstModel();

        // you have order and payment status
        // so you can do whatever you want for example you can just print status and payment details.

        if ($status->isCaptured()) { // faire evenement (ne pas faire le pdf dans le controller)
            // Création de l'évènement avec ses 2 arguments
            $event = new PdfPostEvent($currentCommand, $listTickets);

            // Déclenchement de l'évènement
            $this
                ->get('event_dispatcher')
                ->dispatch(PdfEvents::onPaymentOk, $event)
            ;

            $this->get('session')->getFlashBag()->add('info', 'Paiement accepté, vous allez recevoir vos billets par Email !');
        } else {
            $this->get('session')->getFlashBag()->add('info', 'Un problème c\'est produit lors du paiement, veuillez réessayez !');

            return $this->redirectToRoute('louvre_app_summary', array(
                'bookingCode' => $bookingCode
            ));
        }

        return $this->redirectToRoute('louvre_after_payment');
    }
}