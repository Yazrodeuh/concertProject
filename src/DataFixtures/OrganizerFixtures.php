<?php

namespace App\DataFixtures;

use App\Entity\Organizer;
use App\Entity\Room;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class OrganizerFixtures extends Fixture implements FixtureInterface, ContainerAwareInterface
{

    private ContainerInterface $container;


    public function load(ObjectManager $manager): void
    {

        $repRoom = $this->container->get('doctrine.orm.entity_manager')->getRepository(Room::class);

        $organiser = new Organizer();

        $organiser->setName("organizer1");


        $manager->persist($organiser);

        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

}
