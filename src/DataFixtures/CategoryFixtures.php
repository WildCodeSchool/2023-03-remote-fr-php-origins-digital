<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoryFixtures extends Fixture
{
    public const CATEGORIES = [
        'COMBAT', 'STRATEGIE', 'FPS', 'AVENTURE', 'ARCADE', 'RPG'
    ];

    public function __construct(private SluggerInterface $slugger)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $categoryIds = range(1, count(self::CATEGORIES));

        foreach (array_combine($categoryIds, self::CATEGORIES) as $categoryId => $categoryName) {
            $category = new Category();
            $category->setId($categoryId);
            $category->setName($categoryName);
            $this->addReference('category_' . $categoryName, $category);
            $this->addReference('category_' . $categoryId, $category);
            $category->setSlug($this->slugger->slug($categoryName));
            $manager->persist($category);
        }

        $manager->flush();
    }
}
