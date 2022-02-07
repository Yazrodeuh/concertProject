<?php

namespace App\DataFixtures;

use App\Entity\Organizer;
use App\Entity\Room;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RoomFixtures extends Fixture implements FixtureInterface, DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $repOrganizer = $manager->getRepository(Organizer::class);

        $room = new Room();
        $room->setName("room1");
        $room->setAddress('34 rue perdu');
        $room->setOrganizer($repOrganizer->findOneBy(array('name' => "organizer1")));
        $manager->persist($room);

        $room = new Room();
        $room->setName("room2");
        $room->setAddress('35 rue Trouvé');
        $room->setOrganizer($repOrganizer->findOneBy(array('name' => "organizer1")));
        $manager->persist($room);

        $manager->flush();
    }

    public function getDependencies() :array
    {
        return [
            OrganizerFixtures::class
        ];
    }
}
