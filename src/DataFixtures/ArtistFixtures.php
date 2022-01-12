<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use App\Entity\Band;
use App\Entity\Picture;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ArtistFixtures extends Fixture implements FixtureInterface, DependentFixtureInterface
{

    static array $jobs = ["Singer"];

    public function load(ObjectManager $manager): void
    {

        $repPicture = $manager->getRepository(Picture::class);

        $artist = new Artist();
        $artist->setName("Adèle");
        $artist->setJob(self::$jobs[0]);
        $artist->setBirthday(DateTime::createFromFormat("d/m/Y", "18/01/1935"));
        $manager->persist($artist);

        $artist = new Artist();
        $artist->setName("Dua Lipa");
        $artist->setJob(self::$jobs[0]);
        $artist->setBirthday(DateTime::createFromFormat("d/m/Y", "18/01/1935"));
        $manager->persist($artist);

        $artist = new Artist();
        $artist->setName("Gims");
        $artist->setJob(self::$jobs[0]);
        $artist->setBirthday(DateTime::createFromFormat("d/m/Y", "18/01/1935"));
        $manager->persist($artist);

        $artist = new Artist();
        $artist->setName("Angèle");
        $artist->setJob(self::$jobs[0]);
        $artist->setBirthday(DateTime::createFromFormat("d/m/Y", "18/01/1935"));
        $manager->persist($artist);

        $artist = new Artist();
        $artist->setName("Lomepal");
        $artist->setJob(self::$jobs[0]);
        $artist->setBirthday(DateTime::createFromFormat("d/m/Y", "18/01/1935"));
        $manager->persist($artist);

        $artist = new Artist();
        $artist->setName("Orelsan");
        $artist->setJob(self::$jobs[0]);
        $artist->setBirthday(DateTime::createFromFormat("d/m/Y", "18/01/1935"));
        $manager->persist($artist);

        $artist = new Artist();
        $artist->setName("Nekfeu");
        $artist->setPicture($repPicture->findOneBy(array('name' => 'nekfeu')));
        $artist->setJob(self::$jobs[0]);
        $artist->setBirthday(DateTime::createFromFormat("d/m/Y", "18/01/1935"));
        $manager->persist($artist);

        $artist = new Artist();
        $artist->setName("Black M");
        $artist->setJob(self::$jobs[0]);
        $artist->setBirthday(DateTime::createFromFormat("d/m/Y", "18/01/1935"));
        $manager->persist($artist);

        $artist = new Artist();
        $artist->setName("Lukas Graham");
        $artist->setJob(self::$jobs[0]);
        $artist->setBirthday(DateTime::createFromFormat("d/m/Y", "18/01/1935"));
        $manager->persist($artist);

        $manager->flush();
    }


    public function getDependencies(): array
    {
        return [
            PictureFixtures::class
        ];
    }
}

