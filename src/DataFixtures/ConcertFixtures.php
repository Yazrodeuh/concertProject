<?php

namespace App\DataFixtures;

use App\Entity\Band;
use App\Entity\Concert;
use App\Entity\Room;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ConcertFixtures extends Fixture implements FixtureInterface, ContainerAwareInterface, DependentFixtureInterface
{

    private ContainerInterface $container;

    public function load(ObjectManager $manager): void
    {
        $repBand = $this->container->get("doctrine.orm.entity_manager")->getRepository(Band::class);
        $repRoom = $this->container->get("doctrine.orm.entity_manager")->getRepository(Room::class);

        $concert = new Concert();

        $concert->setName("concert1");
        $concert->setFull(false);
        $concert->addBand($repBand->findOneBy(array("name" =>"bandName1")));
        $concert->setRoom($repRoom->findOneBy(array("name"=> "room1")));

        $manager->persist($concert);

        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function getDependencies(): array
    {
        return [
            BandFixtures::class,
            RoomFixtures::class
        ];
    }
}
