<?php

namespace App\DataFixtures;

use App\Entity\Concert;
use App\Entity\Organizer;
use App\Entity\Room;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class RoomFixtures extends Fixture implements FixtureInterface, ContainerAwareInterface, DependentFixtureInterface
{

    private ContainerInterface $container;

    public function load(ObjectManager $manager): void
    {

        $repConcert = $this->container->get("doctrine.orm.entity_manager")->getRepository(Concert::class);
        $repOrganizer = $this->container->get("doctrine.orm.entity_manager")->getRepository(Organizer::class);

        $room = new Room();
        $room->setName("room1");
        $room->setOrganizer($repOrganizer->findOneBy(array('name' => "organizer1")));

        $manager->persist($room);

        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function getDependencies() :array
    {
        return [
            OrganizerFixtures::class
        ];
    }
}
