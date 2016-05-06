<?php

namespace LOUVRE\AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AfterPaymentControllerTest extends WebTestCase
{
    public function testAfterPaymentPage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/confirmation');

        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }

    public function testAfterPaymentLink()
    {
        $client = static::createClient(array('debug' => true, 'environment' => 'test'), array(
            'HTTP_HOST' => 'louvre.dev'
        ));
        $crawler = $client->request('GET', '/confirmation');
        $link = $crawler->selectLink('Retour à l\'accueil')->link();
        $client->click($link);

        $this->assertEquals('/', $client->getRequest()->getPathInfo());
    }
}