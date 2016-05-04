<?php

namespace LOUVRE\AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AfterPaymentControllerTest extends WebTestCase
{
    public function testAfterPaymentPage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/confirmation');

        $this->assertEquals('LOUVRE\AppBundle\Controller\AppController::afterPaymentAction', $client->getRequest()->attributes->get('_controller'));
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }

    public function testIsAfterPaymentLink()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/confirmation');

        $this->assertCount(2, $crawler->filter('a'));
    }

    public function testAfterPaymentLink()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/confirmation');
        $link = $crawler->selectLink('Retour à l\'accueil')->link();
        $client->click($link);

        $this->assertEquals('LOUVRE\AppBundle\Controller\AppController::homeAction', $client->getRequest()->attributes->get('_controller'));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}