<?php

namespace App\DataFixtures;

use App\Data\PictureList;
use App\Entity\Picture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PictureFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        foreach (PictureList::$pictureList as $value){

            $picture = new Picture();




            $manager->persist($picture);
        }

        $manager->flush();
    }
}
