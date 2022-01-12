<?php

namespace App\DataFixtures;

use App\Entity\Picture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PictureFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $picture = new Picture();
        $picture->setUrl('/img/artists/nekfeu.jpg');
        $picture->setName('nekfeu');
        $picture->setAlternativeName('alternativename');
        $manager->persist($picture);

        $manager->flush();
    }
}
