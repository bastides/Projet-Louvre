<?php

namespace LOUVRE\AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommandTicketsControllerTest extends WebTestCase
{
    public function testCommandTicketsPage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/commande/S356LOUVRE1462346563');

        $this->assertEquals('Veuillez saisir les informations relatives à vos billets.', $crawler->filter('h4')->text());
        $this->assertEquals('LOUVRE\AppBundle\Controller\AppController::commandTicketsAction', $client->getRequest()->attributes->get('_controller'));
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }

    public function testCommandTicketsForm()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/commande/S356LOUVRE1462346563');

        $form = $crawler->selectButton('Valider')->form(array(
            'command[tickets][0][lastname]' => 'Bastide',
            'command[tickets][0][firstname]' => 'Sébastien',
            'command[tickets][0][country]' => 'France',
            'command[tickets][0][birthDate][day]' => '03',
            'command[tickets][0][birthDate][month]' => '05',
            'command[tickets][0][birthDate][year]' => '1985',
            'command[tickets][0][reducedPrice]' => '1',
        ));

        $client->submit($form);
        $this->assertEquals('LOUVRE\AppBundle\Controller\AppController::commandTicketsAction', $client->getRequest()->attributes->get('_controller'));

        /*$this->assertEquals($form, $client->getRequest()->attributes->get('S356LOUVRE1462346563'));

        $client->followRedirect();
        $this->assertEquals('LOUVRE\AppBundle\Controller\AppController::summaryAction', $client->getRequest()->attributes->get('_controller'));
        */
    }
}