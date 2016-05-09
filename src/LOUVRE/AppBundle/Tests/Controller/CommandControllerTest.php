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
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }

    public function testCommandForm()
    {
        $client = static::createClient(array('debug' => true, 'environment' => 'test'), array(
            'HTTP_HOST' => 'louvre.dev'
        ));
        $crawler = $client->request('GET', '/commande');

        $form = $crawler->selectButton('Valider')->form(array(
            'command[bookingDay]' => '10/05/2018',
            'command[ticketType]' => 'Journée',
            'command[quantity]' => '1',
            'command[email]' => 'bastide.sebastien@gmail.com',
        ));
        $client->submit($form);
        $client->followRedirect();

        $this->assertEquals('louvre_app_command_tickets', $client->getRequest()->attributes->get('_route'));
    }
}