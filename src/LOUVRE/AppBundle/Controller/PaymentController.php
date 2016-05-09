<?php
// src/LOUVRE/AppBundle/Controller/PaymentController.php

namespace LOUVRE\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Payum\Core\Request\GetHumanStatus;
use Symfony\Component\HttpFoundation\Request;
use LOUVRE\AppBundle\Entity\PaymentDetails;
use LOUVRE\AppBundle\Pdf\PdfEvents;
use LOUVRE\AppBundle\Pdf\PdfPostEvent;

class PaymentController extends Controller
{
    public function preparePaypalExpressCheckoutPaymentAction($bookingCode)
    {
        $em = $this->getDoctrine()->getManager();

        $currentCommand = $em->getRepository('LOUVREAppBundle:Command')
            ->findOneBy(array('bookingCode' => $bookingCode));
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
            'louvre_payment_done'
        );

        return $this->redirect($captureToken->getTargetUrl());
    }

    public function prepareStripeJsPaymentAction($bookingCode)
    {
        $em = $this->getDoctrine()->getManager();

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
            'louvre_payment_done'
        );

        return $this->redirect($captureToken->getTargetUrl());
    }

    public function captureDoneAction(Request $request)
    {
        $token = $this->get('payum')->getHttpRequestVerifier()->verify($request);
        $identity = $token->getDetails();
        $model = $this->get('payum')->getStorage($identity->getClass())->find($identity);

        $em = $this->getDoctrine()->getManager();
        $commandId = $model->getCommand()->getId();
        $currentCommand = $em->getRepository('LOUVREAppBundle:Command')
            ->find($commandId);
        $listTickets = $em->getRepository('LOUVREAppBundle:Ticket')
            ->findBy(array('command' => $currentCommand));

        $bookingCode = $currentCommand->getBookingCode();
        $gateway = $this->get('payum')->getGateway($token->getGatewayName());

        $gateway->execute($status = new GetHumanStatus($token));
        $details = $status->getFirstModel();

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