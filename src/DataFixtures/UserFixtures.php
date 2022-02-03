<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements FixtureInterface
{
    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        //ADMIN
        $user = new User();
        $user->setEmail('admin@iut.fr');
        $user->setPassword(
            self::getUserPasswordHasher()->hashPassword($user, 'admin')
        );
        $user->setRoles(array('ROLE_USER', 'ROLE_ADMIN'));
        $manager->persist($user);

        //user
        $user = new User();
        $user->setEmail('user@iut.fr');
        $user->setPassword(
            self::getUserPasswordHasher()->hashPassword($user, 'user')
        );
        $user->setRoles(array('ROLE_USER'));
        $manager->persist($user);

        $manager->flush();
    }

    /**
     * @return UserPasswordHasherInterface
     */
    public function getUserPasswordHasher(): UserPasswordHasherInterface
    {
        return $this->userPasswordHasher;
    }
}
