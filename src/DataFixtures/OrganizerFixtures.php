<?php

namespace App\DataFixtures;

use App\Entity\Organizer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OrganizerFixtures extends Fixture implements FixtureInterface
{

    public function load(ObjectManager $manager): void
    {


        $organiser = new Organizer();
        $organiser->setName("organizer1");
        $manager->persist($organiser);

        $manager->flush();
    }

}
