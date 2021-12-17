<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use App\Entity\Band;
use App\Entity\Concert;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class BandFixtures extends Fixture implements FixtureInterface, ContainerAwareInterface, DependentFixtureInterface
{
    private ContainerInterface $container;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function load(ObjectManager $manager): void
    {
        $repArtist = $this->container->get("doctrine.orm.entity_manager")->getRepository(Artist::class);
        $repConcert = $this->container->get("doctrine.orm.entity_manager")->getRepository(Concert::class);

        $band = new Band();

        $band->setName("bandName1");
        $band->setMembersNumber(3);
        $band->setStyle("Rock");
        $band->addArtist($repArtist->findOneBy(array("firstName" => "FirstName1")));
        $band->setPicture(null);

        $manager->persist($band);

        $manager->flush();
    }

    /**
     * @param ContainerInterface|null $container
     * @return void
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
            ArtistFixtures::class,
        ];
    }
}
