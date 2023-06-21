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
        ['file' => 'gaming_house.jpg', 'categorie' => 'category_BANDES-ANNONCES'],
        ['file' => 'docu-categories.jpg', 'categorie' => 'category_DOCUMENTAIRES'],
        ['file' => 'new-categories.jpg', 'categorie' => 'category_NOUVEAUTES'],
        ['file' => 'esport-categories.jpg', 'categorie' => 'category_ESPORT']
    ];

    public function __construct(private ParameterBagInterface $parameterBag)
    {
    }

    public const NB_CATEGORIES = 4;

    public function load(ObjectManager $manager): void
    {
        $uploadImageDir = $this->parameterBag->get('image_dir');
        if (!is_dir(__DIR__ . '/../../public/' . $uploadImageDir)) {
            mkdir(__DIR__ . '/../../public/' . $uploadImageDir, recursive: true);
        }


        for ($i = 1; $i <= self::NB_CATEGORIES; $i++) {
            foreach (self::IMAGESCATEGORIES as $imageData) {
                copy(
                    __DIR__ . '/data/images/' . $imageData['file'],
                    __DIR__ . '/../../public' . $uploadImageDir . '/' . $imageData['file']
                );
                    $image = new ImagesCategories();
                    $image->setFile($imageData['file']);
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
