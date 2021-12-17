<?php

namespace App\DataFixtures;

use App\Data\ConcertList;
use App\Entity\Concert;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ConcertFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        foreach (ConcertList::$concertList as $value) {

            $concert = new Concert();



            $manager->persist($concert);
        }

        $manager->flush();
    }
}
