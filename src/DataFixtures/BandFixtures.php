<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use App\Entity\Band;
use App\Entity\Picture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BandFixtures extends Fixture implements FixtureInterface, DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $repArtist = $manager->getRepository(Artist::class);
        $repPicture = $manager->getRepository(Picture::class);

        $band = new Band();
        $artist = $repArtist->findOneBy(array('name' => 'Adèle'));
        $band->setName($artist->getName());
        $band->setUrlName('adele');
        $band->setMembersNumber(1);
        $band->addArtist($artist);
        $band->setPicture($artist->getPicture());
        $manager->persist($band);

        $band = new Band();
        $artist = $repArtist->findOneBy(array('name' => 'Dua Lipa'));
        $band->setName($artist->getName());
        $band->setUrlName('dualipa');
        $band->setMembersNumber(1);
        $band->addArtist($artist);
        $band->setPicture($artist->getPicture());
        $manager->persist($band);

        $band = new Band();
        $artist = $repArtist->findOneBy(array('name' => 'Gims'));
        $band->setName($artist->getName());
        $band->setUrlName('gims');
        $band->setMembersNumber(1);
        $band->addArtist($artist);
        $band->setPicture($artist->getPicture());
        $manager->persist($band);

        $band = new Band();
        $artist = $repArtist->findOneBy(array('name' => 'Angèle'));
        $band->setName($artist->getName());
        $band->setUrlName('angele');
        $band->setMembersNumber(1);
        $band->addArtist($artist);
        $band->setPicture($artist->getPicture());
        $manager->persist($band);

        $band = new Band();
        $artist = $repArtist->findOneBy(array('name' => 'Lomepal'));
        $band->setName($artist->getName());
        $band->setUrlName('lomepal');
        $band->setMembersNumber(1);
        $band->addArtist($artist);
        $band->setPicture($artist->getPicture());
        $manager->persist($band);

        $band = new Band();
        $artist = $repArtist->findOneBy(array('name' => 'Orelsan'));
        $band->setName($artist->getName());
        $band->setUrlName('orelsan');
        $band->setMembersNumber(1);
        $band->addArtist($artist);
        $band->setPicture($artist->getPicture());
        $manager->persist($band);

        $band = new Band();
        $artist = $repArtist->findOneBy(array('name' => 'Nekfeu'));
        $band->setName($artist->getName());
        $band->setUrlName('nekfeu');
        $band->setMembersNumber(1);
        $band->addArtist($artist);
        $band->setPicture($artist->getPicture());
        $manager->persist($band);

        $band = new Band();
        $artist = $repArtist->findOneBy(array('name' => 'Black M'));
        $band->setName($artist->getName());
        $band->setUrlName('blackm');
        $band->setMembersNumber(1);
        $band->addArtist($artist);
        $band->setPicture($artist->getPicture());
        $manager->persist($band);

        $band = new Band();
        $artist = $repArtist->findOneBy(array('name' => 'Lukas Graham'));
        $band->setName($artist->getName());
        $band->setUrlName('lukasgraham');
        $band->setMembersNumber(1);
        $band->addArtist($artist);
        $band->setPicture($artist->getPicture());
        $manager->persist($band);

        $band = new Band();
        $artist = $repArtist->findOneBy(array('name' => 'Louane'));
        $band->setName($artist->getName());
        $band->setUrlName('louane');
        $band->setMembersNumber(1);
        $band->addArtist($artist);
        $band->setPicture($artist->getPicture());
        $manager->persist($band);

        $band = new Band();
        $artistDuaLipa = $repArtist->findOneBy(array('name' => 'Dua Lipa'));
        $artistAngele = $repArtist->findOneBy(array('name' => 'Angèle'));
        $band->setName($artistDuaLipa->getName() . ' - ' . $artistAngele->getName());
        $band->setUrlName('dualipa-angele');
        $band->setMembersNumber(1);
        $band->addArtist($artistAngele);
        $band->addArtist($artistDuaLipa);
        $band->setPicture($repPicture->findOneBy(array('name' => 'dualipa-angele')));
        $manager->persist($band);

        $band = new Band();
        $artistLouane = $repArtist->findOneBy(array('name' => 'Louane'));
        $artistAdele = $repArtist->findOneBy(array('name' => 'Angèle'));
        $artistLukasGraham = $repArtist->findOneBy(array('name' => 'Lukas Graham'));
        $band->setName('The sentimentals');
        $band->setUrlName('the-sentimentals');
        $band->setMembersNumber(3);
        $band->addArtist($artistLouane);
        $band->addArtist($artistAdele);
        $band->addArtist($artistLukasGraham);
        $band->setPicture($repPicture->findOneBy(array('name' => 'the-sentimentals')));
        $manager->persist($band);

        $band = new Band();
        $artist = $repArtist->findOneBy(array('name' => 'Orelsan'));
        $artist1 = $repArtist->findOneBy(array('name' => 'Nekfeu'));
        $artist2 = $repArtist->findOneBy(array('name' => 'Gims'));
        $band->setName('Raper le fromage');
        $band->setUrlName('raper-le-fromage');
        $band->setMembersNumber(3);
        $band->addArtist($artist);
        $band->addArtist($artist1);
        $band->addArtist($artist2);
        $band->setPicture($repPicture->findOneBy(array('name' => 'raper-le-fromage')));
        $manager->persist($band);

        $manager->flush();
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
            ArtistFixtures::class,
            PictureFixtures::class,
        ];
    }
}
