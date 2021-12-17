<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use App\Entity\Band;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ArtistFixtures extends Fixture implements FixtureInterface, ContainerAwareInterface
{

    private ContainerInterface $container;

    public function load(ObjectManager $manager): void
    {
        $repBands = $this->container->get('doctrine.orm.entity_manager')->getRepository(Band::class);

        $artist = new Artist();
        $artist->setFirstName("FirstName1");
        $artist->setLastName("LastName1");
        $artist->setBirthday(DateTime::createFromFormat("d/m/Y", "18/01/1935"));

        $manager->persist($artist);

        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null)
    {
       $this->container = $container;
    }


}

