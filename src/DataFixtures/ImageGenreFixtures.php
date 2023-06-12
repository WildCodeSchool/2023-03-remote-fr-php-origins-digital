<?php

namespace App\DataFixtures;

use App\Entity\ImageGenre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ImageGenreFixtures extends Fixture
{
    public const IMAGES = [
        '1' => ['1', 'combat-background.jpg', 'combat-character.png', 'combat-text.png'],
        '2' => ['2', 'strategy-background.jpg', 'strategy-character.png', 'strategy-text.png'],
        '3' => ['3', 'fps-background.jpg', 'fps-character.png', 'fps-text.png'],
        '4' => ['4', 'adventure-background.jpg', 'adventure-character.png', 'adventure-text.png'],
        '5' => ['5', 'arcade-background.jpg', 'arcade-character.png', 'arcade-text.png'],
        '6' => ['6', 'rpg-background.jpg', 'rpg-character.png', 'rpg-text.png'],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::IMAGES as $genreId => $imageData) {
            $genreImage = new ImageGenre();
            $genreImage->setId((int)$imageData[0]);
            $genreImage->setBackground($imageData[1]);
            $genreImage->setGenreCharacter($imageData[2]);
            $genreImage->setGenreName($imageData[3]);
            $genreImage->setGenre($this->getReference('genre_' . $genreId));
            $manager->persist($genreImage);
        }
        $manager->flush();
    }
}
