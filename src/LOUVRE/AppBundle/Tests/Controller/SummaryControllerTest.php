<?php

namespace LOUVRE\AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SummaryControllerTest extends WebTestCase
{
    public function testSummaryPage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/resume/Z414LOUVRE1462891680');

        $this->assertEquals('Votre commande', $crawler->filter('h2')->text());
        $this->assertEquals('Commande N° Z414LOUVRE1462891680', $crawler->filter('#table-head')->text());
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }

    public function testPaypalLink()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/résumé/Z414LOUVRE1462891680');

        $link = $crawler->selectLink('PAYPAL')->link();
        $client->click($link);

        $client->followRedirect();
        $this->assertEquals('Payum\Bundle\PayumBundle\Controller\CaptureController::doAction', $client->getRequest()->attributes->get('_controller'));
    }

    public function testStripeLink()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/résumé/Z414LOUVRE1462891680');

        $link = $crawler->selectLink('CARTE BANCAIRE')->link();
        $client->click($link);

        $client->followRedirect();
        $this->assertEquals('Payum\Bundle\PayumBundle\Controller\CaptureController::doAction', $client->getRequest()->attributes->get('_controller'));
    }
}