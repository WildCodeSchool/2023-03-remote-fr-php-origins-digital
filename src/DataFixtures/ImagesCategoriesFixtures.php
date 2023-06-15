<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use App\Entity\ImagesCategories;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ImagesCategoriesFixtures extends Fixture implements DependentFixtureInterface
{
    public const IMAGESCATEGORIES = [
        ['name' => 'bande-annonces-categories.jpg', 'categorie' => 'category_BANDES_ANNONCES'],
        ['name' => 'docu-categories.jpg', 'categorie' => 'category_DOCUMENTAIRES'],
        ['name' => 'new-categories.jpg', 'categorie' => 'category_NOUVEAUTES'],
        ['name' => 'esport-categories.jpg', 'categorie' => 'category_ESPORT']
    ];

    public function __construct(private ParameterBagInterface $parameterBag)
    {
    }

    public const NB_CATEGORIES = 4;

    public function load(ObjectManager $manager): void
    {
        $uploadImageDir = $this->parameterBag->get('upload_image_dir');
        if (!is_dir(__DIR__ . '/../../public/' . $uploadImageDir)) {
            mkdir(__DIR__ . '/../../public/' . $uploadImageDir, recursive: true);
        }


        for ($i = 1; $i <= self::NB_CATEGORIES; $i++) {
            foreach (self::IMAGESCATEGORIES as $imageData) {
                copy(
                    __DIR__ . '/data/images/' . $imageData['name'],
                    __DIR__ . '/../../public' . $uploadImageDir . '/' . $imageData['name']
                );
                    $image = new ImagesCategories();
                    $image->setFile($imageData['name']);
                    $image->setCategories($this->getReference($imageData['categorie'] . '_' . $i));
                    $manager->persist($image);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoriesFixtures::class,
        ];
    }
}
