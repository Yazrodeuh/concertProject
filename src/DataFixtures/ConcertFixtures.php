<?php

namespace App\DataFixtures;

use App\Entity\Band;
use App\Entity\Concert;
use App\Entity\Picture;
use App\Entity\Room;
use DateTime;
use App\DataFixtures\PictureFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ConcertFixtures extends Fixture implements FixtureInterface, DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $repBand = $manager->getRepository(Band::class);
        $repRoom = $manager->getRepository(Room::class);
        $repPicture = $manager->getRepository(Picture::class);

        $concert = new Concert();
        $band = $repBand->findOneBy(array("urlName" =>"dualipa-angele"));
        $concert->setName("Dua Lipa et Angèle en concert");
        $concert->setFull(false);
        $concert->addBand($band);
        $concert->setRoom($repRoom->findOneBy(array("name"=> "room1")));
        $concert->setPicture($band->getPicture());
        $concert->setStartTime("20:00");
        $concert->setEndTime("02:00");
        $concert->setDay(DateTime::createFromFormat("d/m/Y", "12/02/2011"));
        $manager->persist($concert);

        $concert = new Concert();
        $band = $repBand->findOneBy(array("urlName" =>"raper-le-fromage"));
        $concert->setName("Raper le fromage en Gruillère");
        $concert->setFull(false);
        $concert->addBand($band);
        $concert->setRoom($repRoom->findOneBy(array("name"=> "room2")));
        $concert->setPicture($band->getPicture());
        $concert->setStartTime("20:00");
        $concert->setEndTime("03:00");
        $concert->setDay(DateTime::createFromFormat("d/m/Y", "12/02/2034"));
        $manager->persist($concert);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            BandFixtures::class,
            RoomFixtures::class,
            PictureFixtures::class
        ];
    }
}
