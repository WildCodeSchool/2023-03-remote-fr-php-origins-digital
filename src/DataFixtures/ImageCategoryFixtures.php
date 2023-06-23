<?php

namespace App\DataFixtures;

use App\Entity\ImageCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ImageCategoryFixtures extends Fixture
{
    public const IMAGES = [
        '1' => ['1', 'combat-background.jpg', 'combat-character.png', 'combat-text.png'],
        '2' => ['2', 'strategy-background.jpg', 'strategy-character.png', 'strategy-text.png'],
        '3' => ['3', 'fps-background.jpg', 'fps-character.png', 'fps-text.png'],
        '4' => ['4', 'adventure-background.jpg', 'adventure-character.png', 'adventure-text.png'],
        '5' => ['5', 'arcade-background.jpg', 'arcade-character.png', 'arcade-text.png'],
        '6' => ['6', 'rpg-background.jpg', 'rpg-character.png', 'rpg-text.png'],
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

        foreach (self::IMAGES as $categoryId => $imageData) {
            copy(
                __DIR__ . '/data/images/' . $imageData[1],
                __DIR__ . '/../../public' . $uploadImageDir . '/' . $imageData[1]
            );
            copy(
                __DIR__ . '/data/images/' . $imageData[2],
                __DIR__ . '/../../public' . $uploadImageDir . '/' . $imageData[2]
            );
            copy(
                __DIR__ . '/data/images/' . $imageData[3],
                __DIR__ . '/../../public' . $uploadImageDir . '/' . $imageData[3]
            );
            $categoryImage = new ImageCategory();
            $categoryImage->setId((int)$imageData[0]);
            $categoryImage->setBackground($imageData[1]);
            $categoryImage->setCategoryCharacter($imageData[2]);
            $categoryImage->setCategoryName($imageData[3]);
            $categoryImage->setCategory($this->getReference('category_' . $categoryId));
            $manager->persist($categoryImage);
        }
        $manager->flush();
    }
}
