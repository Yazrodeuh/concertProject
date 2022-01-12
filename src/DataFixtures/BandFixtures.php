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
        $artist = $repArtist->findOneBy(array('name' => 'Lukas Graham'));
        $band->setName($artist->getName());
        $band->setUrlName('lukasgraham');
        $band->setMembersNumber(1);
        $band->addArtist($artist);
        $band->setPicture(null);
        $manager->persist($band);

        $band = new Band();
        $artist = $repArtist->findOneBy(array('name' => 'Nekfeu'));
        $band->setName($artist->getName());
        $band->setUrlName('nekfeu');
        $band->setMembersNumber(1);
        $band->addArtist($artist);
        $band->setPicture(null);
        $manager->persist($band);

        $band = new Band();
        $artist = $repArtist->findOneBy(array('name' => 'Orelsan'));
        $band->setName($artist->getName());
        $band->setUrlName('orelsan');
        $band->setMembersNumber(1);
        $band->addArtist($artist);
        $band->setPicture(null);
        $manager->persist($band);

        $band = new Band();
        $artist = $repArtist->findOneBy(array('name' => 'Lomepal'));
        $band->setName($artist->getName());
        $band->setUrlName('lomepal');
        $band->setMembersNumber(1);
        $band->addArtist($artist);
        $band->setPicture(null);
        $manager->persist($band);

        $band = new Band();
        $artistDuaLipa = $repArtist->findOneBy(array('name' => 'Dua Lipa'));
        $artistAngele = $repArtist->findOneBy(array('name' => 'Angèle'));
        $band->setName($artistDuaLipa->getName() . ' - ' . $artistAngele->getName());
        $band->setUrlName('dualipa-angele');
        $band->setMembersNumber(1);
        $band->addArtist($artistAngele);
        $band->addArtist($artistDuaLipa);
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
