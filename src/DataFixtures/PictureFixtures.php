<?php

namespace App\DataFixtures;

use App\Entity\Picture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PictureFixtures extends Fixture implements FixtureInterface
{

    public function load(ObjectManager $manager): void
    {

        $nekfeu = new Picture();
        $nekfeu->setUrl('/img/artists/nekfeu.jpg');
        $nekfeu->setName('nekfeu');
        $nekfeu->setAlternativeName('alternativename');
        $manager->persist($nekfeu);

        $dualipa_angele = new Picture();
        $dualipa_angele->setUrl('/img/bands/dualipa-angele.jpg');
        $dualipa_angele->setName('dualipa-angele');
        $dualipa_angele->setAlternativeName('alternativename');
        $manager->persist($dualipa_angele);

        $dualipa_angele = new Picture();
        $dualipa_angele->setUrl('/img/bands/the-sentimentals.jpg');
        $dualipa_angele->setName('dualipa-angele');
        $dualipa_angele->setAlternativeName('alternativename');
        $manager->persist($dualipa_angele);

        $dualipa_angele = new Picture();
        $dualipa_angele->setUrl('/img/bands/raper-le-fromage.jpg');
        $dualipa_angele->setName('raper-le-fromage');
        $dualipa_angele->setAlternativeName('alternativename');
        $manager->persist($dualipa_angele);

        $manager->flush();

    }
}
