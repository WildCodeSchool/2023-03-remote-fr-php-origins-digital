<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class CategoriesFixtures extends Fixture implements DependentFixtureInterface
{
    public const CATEGORIES = [
        ['name' => 'BANDES-ANNONCES', 'file' => 'gaming_house.jpg'],
        ['name' => 'DOCUMENTAIRES', 'file' => 'docu-categories.jpg'],
        ['name' => 'NOUVEAUTES', 'file' => 'new-categories.jpg'],
        ['name' => 'ESPORT', 'file' => 'esport-categories.jpg']
    ];

    public function __construct(private ParameterBagInterface $parameterBag)
    {
    }


    public function load(ObjectManager $manager): void
    {
        $uploadImageDir = $this->parameterBag->get('image_dir');
        if (!is_dir(__DIR__ . '/../../public' . $uploadImageDir)) {
            mkdir(__DIR__ . '/../../public' . $uploadImageDir, recursive: true);
        }

        foreach (self::CATEGORIES as $categoriesData) {
            for ($i = 1; $i <= 6; $i++) {
                $category = new Categories();
                $category->setGenre($this->getReference('genre_' . $i));
                $category->setName($categoriesData['name']);

                // Définir le chemin d'accès au fichier
                $filePath = __DIR__ . '/data/images/' . $categoriesData['file'];
                $destinationPath = __DIR__ . '/../../public' . $uploadImageDir . '/' . $categoriesData
                    ['file'];

                // Copier le fichier vers le répertoire de destination
                copy($filePath, $destinationPath);

                $category->setFile($categoriesData['file']);
                $this->addReference('genre_' . $i . '_' . $categoriesData['name'], $category);
                $manager->persist($category);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            GenreFixtures::class,
        ];
    }
}
