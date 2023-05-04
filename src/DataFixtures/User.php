<?php

namespace App\DataFixtures;

// use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class User extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        $user = new \App\Entity\User();
        $user->setLogin('fermier@gmail.com');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            'passer'
        );
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_CLIENT']);
        $user1 = new \App\Entity\User();
        $user1->setLogin('employe@gmail.com');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user1,
            'passer'
        );
        $user1->setPassword($hashedPassword);
        $user1->setRoles(['ROLE_GESTIONNAIRE']);
        $manager->persist($user);
        $manager->persist($user1);
        $manager->flush();
    }
}