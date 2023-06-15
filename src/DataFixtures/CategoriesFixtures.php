<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CategoriesFixtures extends Fixture implements DependentFixtureInterface
{
    public const CATEGORIES = [
        'BANDES_ANNONCES', 'DOCUMENTAIRES', 'NOUVEAUTES', 'ESPORT'
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::CATEGORIES as $categorieData) {
            for ($i = 1; $i <= 6; $i++) {
                $categorie = new Categories();
                $categorie->setGenre($this->getReference('genre_' . $i));
                $categorie->setName($categorieData);
                $this->addReference('category_' . $categorieData . '_' . $i, $categorie);
                $manager->persist($categorie);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return[
            GenreFixtures::class,
        ];
    }
}
