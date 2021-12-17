<?php

namespace App\DataFixtures;

use App\Data\OrganizerList;
use App\Entity\Organizer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrganizerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        foreach (OrganizerList::$organizerList as $value){

            $organizer = new Organizer();




            $manager->persist($organizer);
        }

        $manager->flush();
    }
}
