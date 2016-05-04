<?php

namespace LOUVRE\AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommandControllerTest extends WebTestCase
{
    public function testCommandPage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/commande');

        $this->assertEquals('Veuillez saisir les informations relatives à votre commande.', $crawler->filter('h4')->text());
        $this->assertEquals('LOUVRE\AppBundle\Controller\AppController::commandAction', $client->getRequest()->attributes->get('_controller'));
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }

    public function testCommandForm()
    {
        /*$client = static::createClient();
        $crawler = $client->request('GET', '/commande');

        $form = $crawler->selectButton('Valider')->form(array(
            'command[bookingDay]' => new \DateTime('2017-05-03'),
            'command[ticketType]' => 'Journée',
            'command[quantity]' => '1',
            'command[email]' => 'bastide.sebastien@gmail.com',
        ));

        $client->submit($form);
        $this->assertEquals('LOUVRE\AppBundle\Controller\AppController::commandAction', $client->getRequest()->attributes->get('_controller'));

        $client->followRedirect();
        $this->assertEquals('LOUVRE\AppBundle\Controller\AppController::commandTicketsAction', $client->getRequest()->attributes->get('_controller'));
        */
        
    }
}