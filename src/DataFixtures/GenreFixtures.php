<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GenreFixtures extends Fixture
{
    public const GENRES = [
        'COMBAT', 'STRATEGIE', 'FPS', 'AVENTURE', 'ARCADE', 'RPG'
    ];
    public function load(ObjectManager $manager): void
    {
        $genreIds = range(1, count(self::GENRES));

        foreach (array_combine($genreIds, self::GENRES) as $genreId => $genreName) {
            $genre = new Genre();
            $genre->setId($genreId);
            $genre->setName($genreName);
            $this->addReference('genre_' . $genreId, $genre);
            $manager->persist($genre);
        }

        $manager->flush();
    }
}
