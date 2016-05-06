<?php

namespace LOUVRE\AppBundle\Tests\Controller;    

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testHomePage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }

    public function testHomeLink()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $link = $crawler->selectLink('Passer commande')->link();
        $client->click($link);
        
        $this->assertEquals('/commande', $client->getRequest()->getPathInfo()); // Retourne l'url
    }
}