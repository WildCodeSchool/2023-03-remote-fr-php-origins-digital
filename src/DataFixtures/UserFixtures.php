<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private Generator $faker;

    public function __construct(private readonly UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 2; $i++) {
            $user = new User();
            $user->setFullName($this->faker->name())
                ->setPseudo(mt_rand(0, 1) === 1 ? $this->faker->firstName() : null)
                ->setEmail($this->faker->email())
                ->setRoles(['ROLE_USER'])
                ->setCreatedAt(new DateTimeImmutable())
                ->setPassword($this->userPasswordHasher->hashPassword($user, 'password'));
            $manager->persist($user);
        }
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
