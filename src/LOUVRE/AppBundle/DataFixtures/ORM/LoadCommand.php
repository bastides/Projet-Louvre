<?php

namespace LOUVRE\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use LOUVRE\AppBundle\Entity\Command;
use LOUVRE\AppBundle\Entity\Ticket;

class LoadCommand implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $command1 = new Command();
        $command1->setBookingDay(new \DateTime('2018-05-10'));
        $command1->setTicketType('Journée');
        $command1->setQuantity(1);
        $command1->setEmail('maluret.jerome@gmail.com');
        $command1->setBookingCode('Z414LOUVRE1462891680');
        $command1->setTotalprice(12.00);

        $ticket = new Ticket();
        $ticket->setCommand($command1);
        $ticket->setLastname('Maluret');
        $ticket->setFirstname('Jérome');
        $ticket->setCountry('France');
        $ticket->setBirthDate(new \DateTime('1920-01-01'));
        $ticket->setReducedPrice(false);
        $ticket->setPrice(12.00);
        $ticket->setTicketname('Billet sénior');

        $manager->persist($command1);
        $manager->persist($ticket);

        $manager->flush();

    }
}
