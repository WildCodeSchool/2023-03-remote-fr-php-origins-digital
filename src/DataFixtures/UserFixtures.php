<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $userPasswordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setFullName('User Test')
            ->setPseudo('User')
            ->setEmail('Roleuser@gmail.com')
            ->setRoles(['ROLE_USER'])
            ->setCreatedAt(new DateTimeImmutable())
            ->setPassword($this->userPasswordHasher->hashPassword($user, 'userrole'));
        $manager->persist($user);

        $admin = new User();
        $admin->setFullName('Admin Test')
            ->setPseudo('Admin')
            ->setEmail('Roleadmin@gmail.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setCreatedAt(new DateTimeImmutable())
            ->setPassword($this->userPasswordHasher->hashPassword($admin, 'adminrole'));
        $manager->persist($admin);

        $manager->flush();
    }
}
