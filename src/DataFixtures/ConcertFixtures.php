<?php

namespace App\DataFixtures;

use App\Entity\Band;
use App\Entity\Concert;
use App\Entity\Room;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ConcertFixtures extends Fixture implements FixtureInterface, DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $repBand = $manager->getRepository(Band::class);
        $repRoom = $manager->getRepository(Room::class);


        $concert = new Concert();

        $concert->setName("concert1");
        $concert->setFull(false);
        $concert->addBand($repBand->findOneBy(array("name" =>"bandName1")));
        $concert->setRoom($repRoom->findOneBy(array("name"=> "room1")));
        $concert->setStartTime(DateTime::createFromFormat("d/m/Y G:i", "24/05/2030 21:30"));
        $concert->setEndTime(DateTime::createFromFormat("d/m/Y G:i", "25/05/2030 00:30"));

        $manager->persist($concert);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            BandFixtures::class,
            RoomFixtures::class
        ];
    }
}
