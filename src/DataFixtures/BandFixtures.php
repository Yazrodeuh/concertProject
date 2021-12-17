<?php

namespace App\DataFixtures;

use App\Data\BandList;
use App\Entity\Band;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BandFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        foreach (BandList::$bandList as $value){

            $band = new Band();

            $band->setName($value['name']);
            $band->setMembersNumber($value['membersNumber']);
            $band->setStyle($value['style']);
            //TODO manque picture

            $manager->persist($band);

        }

        $manager->flush();
    }
}
