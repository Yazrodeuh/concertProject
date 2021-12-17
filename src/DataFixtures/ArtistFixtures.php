<?php

namespace App\DataFixtures;

use App\Data\ArtistList;
use App\Entity\Artist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArtistFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        foreach (ArtistList::$artistList as $value){

            $artist = new Artist();
            $artist->setFirstName();
            $artist->setLastName();
            $artist->setBirthday();

            $manager->persist($artist);
        }

        $manager->flush();
    }
}
