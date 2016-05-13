<?php

namespace LOUVRE\AppBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use LOUVRE\AppBundle\DataFixtures\ORM\LoadCommand;

class CommandTicketsControllerTest extends WebTestCase
{
    public function setUp()
    {
        $this->loadFixtures(array('LOUVRE\AppBundle\DataFixtures\ORM\LoadCommand'));
    }

    public function testCommandTicketsPage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/commande/Z414LOUVRE1462891680');

        $this->assertEquals('Veuillez saisir les informations relatives à vos billets.', $crawler->filter('h4')->text());
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }

    public function testCommandTicketsForm()
    {
        $client = static::createClient(array('debug' => true, 'environment' => 'test'), array(
            'HTTP_HOST' => 'louvre.dev'
        ));
        $crawler = $client->request('GET', '/commande/Z414LOUVRE1462891680');

        $form = $crawler->selectButton('Valider')->form(array(
            'command[tickets][0][lastname]' => 'MALURET',
            'command[tickets][0][firstname]' => 'Jérome',
            'command[tickets][0][country]' => 'France',
            'command[tickets][0][birthDate][day]' => 01,
            'command[tickets][0][birthDate][month]' => 01,
            'command[tickets][0][birthDate][year]' => 1920,
            'command[tickets][0][reducedPrice]' => false,
        ));
        $client->submit($form);
        $client->followRedirect();

        $this->assertEquals('louvre_app_summary', $client->getRequest()->attributes->get('_route'));
    }
}