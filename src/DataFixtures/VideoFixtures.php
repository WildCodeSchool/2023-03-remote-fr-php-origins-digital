<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class VideoFixtures extends Fixture implements DependentFixtureInterface
{
    public const VIDEOS = [
        ['title' => 'Gameplay clavier', 'time' => 9, 'video_url' => 'clavier.mp4', 'views' => 5,
            'is_private' => false, 'is_upcoming' => true, 'video_number' => '1', 'image' => 'clavier.jpg',
            'tags' => ['ESPORT', 'NOUVEAUTES'], 'categorie' => 'COMBAT'],
        ['title' => 'Gameplay call of duty ps4', 'time' => 31, 'video_url' => 'gameplay_call_of_duty.mp4',
            'views' => 25, 'is_private' => false, 'is_upcoming' => true, 'video_number' => '2',
            'image' => 'playstation_call_of_duty.jpg',
            'tags' => ['NOUVEAUTES', 'BANDES-ANNONCES'], 'categorie' => 'FPS'],
        ['title' => 'Gameplay fifa', 'time' => 10, 'video_url' => 'gameplay_fifa.mp4', 'views' => 11,
            'is_private' => false, 'is_upcoming' => true, 'video_number' => '3', 'image' => 'fifa_gameplay.jpg',
            'tags' => ['ESPORT', 'NOUVEAUTES'], 'categorie' => 'AVENTURE'],
        ['title' => 'League of Legends à la manette', 'time' => 39,
            'video_url' => 'gameplay_manette_league_of_legend.mp4',
            'views' => 29, 'is_private' => false, 'is_upcoming' => true, 'video_number' => '4',
            'image' => 'manette_league_of_legends.jpg',
            'tags' => ['ESPORT'], 'categorie' => 'STRATEGIE'],
        ['title' => 'Gaming house', 'time' => 18, 'video_url' => 'gaming_house.mp4', 'views' => 5,
            'is_private' => true, 'is_upcoming' => true, 'video_number' => '5', 'image' => 'gaming_house.jpg',
            'tags' => ['DOCUMENTAIRES'], 'categorie' => 'FPS'],
        ['title' => 'Gameplay jeux pc', 'time' => 27, 'video_url' => 'gameplay.mp4', 'views' => 9,
            'is_private' => true, 'is_upcoming' => true, 'video_number' => '6', 'image' => 'gameplay_pc.jpg',
            'tags' => ['DOCUMENTAIRES'], 'categorie' => 'STRATEGIE'],
        ['title' => 'League of Legends', 'time' => 6, 'video_url' => 'league_of_legends.mp4', 'views' => 2,
            'is_private' => true, 'is_upcoming' => true, 'video_number' => '7', 'image' => 'League_of_legends.jpg',
            'tags' => ['BANDES-ANNONCES'], 'categorie' => 'ARCADE'],
        ['title' => 'Gameplay manette ps5', 'time' => 14, 'video_url' => 'manette_ps5.mp4', 'views' => 12,
            'is_private' => true, 'is_upcoming' => true, 'video_number' => '8', 'image' => 'manette_ps5.jpg',
            'tags' => ['BANDES-ANNONCES', 'NOUVEAUTES'], 'categorie' => 'RPG'],
        ['title' => 'Among Us', 'time' => 4, 'video_url' => 'among_us.mp4', 'views' => 52,
            'is_private' => false, 'is_upcoming' => true,
            'image' => 'among_us.jpg', 'tags' => ['BANDES-ANNONCES'], 'categorie' => 'RPG'],
        ['title' => 'Minecraft', 'time' => 4, 'video_url' => 'dance_mincrecraft.mp4',
            'views' => 52, 'is_private' => false, 'is_upcoming' => true,
             'image' => 'minecraft.jpg', 'tags' => ['BANDES-ANNONCES', 'NOUVEAUTES'], 'categorie' => 'RPG'],
        ['title' => 'Manette', 'time' => 4, 'video_url' => 'gaming_manette.mp4', 'views' => 52,
            'is_private' => false, 'is_upcoming' => true,
            'image' => 'manette.jpg', 'tags' => ['BANDES-ANNONCES', 'NOUVEAUTES'], 'categorie' => 'RPG'],
        ['title' => 'Virtuel', 'time' => 4, 'video_url' => 'grid.mp4', 'views' => 52,
            'is_private' => false, 'is_upcoming' => true,
            'image' => 'virtuel.jpg', 'tags' => ['NOUVEAUTES'], 'categorie' => 'STRATEGIE'],
        ['title' => 'Pokemon', 'time' => 4, 'video_url' => 'pokemon.mp4', 'views' => 52,
            'is_private' => false, 'is_upcoming' => true, 'image' => 'pokemon.jpg',
            'tags' => ['BANDES-ANNONCES', 'ESPORT'], 'categorie' => 'ARCADE'],
        ['title' => 'Spacecraft', 'time' => 4, 'video_url' => 'spacecraft.mp4', 'views' => 52,
            'is_private' => false, 'is_upcoming' => true, 'image' => 'spacecraft.jpg',
            'tags' => ['BANDES-ANNONCES', 'NOUVEAUTES'], 'categorie' => 'COMBAT'],
        ['title' => 'Age of Empires', 'time' => 9, 'video_url' => 'Age_of_Empires.mp4', 'views' => 42,
            'is_private' => true, 'is_upcoming' => true, 'image' => 'age_of_empire.jpeg',
            'tags' => ['NOUVEAUTES'], 'categorie' => 'STRATEGIE'],
        ['title' => 'Valorant', 'time' => 32, 'video_url' => 'Dancin_Valorant.mp4', 'views' => 4,
            'is_private' => true, 'is_upcoming' => true, 'image' => 'valorant.jpg',
            'tags' => ['ESPORT'], 'categorie' => 'FPS'],
        ['title' => 'Starcraft II', 'time' => 56, 'video_url' => 'Starcraft_II.mp4', 'views' => 4,
            'is_private' => true, 'is_upcoming' => true, 'image' => 'starcraft2.jpeg',
            'tags' => ['BANDES-ANNONCES'], 'categorie' => 'FPS'],
        ['title' => 'Street Fighter 6 Guilde', 'time' => 1, 'video_url' => 'Street_Fighter_6_Guile.mp4', 'views' => 4,
            'is_private' => true, 'is_upcoming' => true, 'image' => 'street_Fighter_6_guilde.jpg',
            'tags' => ['BANDES-ANNONCES'], 'categorie' => 'COMBAT'],
        ['title' => 'Street Fighter 6 Rashid', 'time' => 2, 'video_url' => 'Street_Fighter_6_Rashid.mp4', 'views' => 4,
            'is_private' => false, 'is_upcoming' => true, 'image' => 'Street-fighter-6-rashid.jpg',
            'tags' => ['ESPORT'], 'categorie' => 'COMBAT'],
        ['title' => 'Total War', 'time' => 12, 'video_url' => 'Total_War.mp4', 'views' => 4,
            'is_private' => false, 'is_upcoming' => true, 'image' => 'total_war_2.jpeg',
            'tags' => ['NOUVEAUTES'], 'categorie' => 'STRATEGIE'],
        ['title' => 'Valorant Wake up', 'time' => 19, 'video_url' => 'Wake_Up_Valorant.mp4', 'views' => 4,
            'is_private' => false, 'is_upcoming' => true, 'image' => 'valorant_wake_up.jpg',
            'tags' => ['ESPORT'], 'categorie' => 'FPS'],
    ];

    public function __construct(private ParameterBagInterface $parameterBag)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $uploadVideoDir = $this->parameterBag->get('video_dir');
        if (!is_dir(__DIR__ . '/../../public' . $uploadVideoDir)) {
            mkdir(__DIR__ . '/../../public' . $uploadVideoDir, recursive: true);
        }

        $uploadImageDir = $this->parameterBag->get('image_dir');
        if (!is_dir(__DIR__ . '/../../public' . $uploadImageDir)) {
            mkdir(__DIR__ . '/../../public' . $uploadImageDir, recursive: true);
        }

        $faker = Factory::create('fr_FR');
        foreach (self::VIDEOS as $videoData) {
            copy(
                __DIR__ . '/data/videos/' . $videoData['video_url'],
                __DIR__ . '/../../public' . $uploadVideoDir . '/' . $videoData['video_url']
            );
            copy(
                __DIR__ . '/data/images/' . $videoData['image'],
                __DIR__ . '/../../public' . $uploadImageDir . '/' . $videoData['image']
            );

            $video = new Video();
            $video->setTitle($videoData['title']);
            $video->setDescription(implode("", array_map(function ($item) {
                return '<p>' . $item . '</p>';
            }, $faker->paragraphs($faker->numberBetween(2, 3)))));
            $video->setTime($videoData['time']);
            $video->setVideoUrl($videoData['video_url']);
            $video->setViews($videoData['views']);
            $video->setPrivate($videoData['is_private']);
            $video->setRealeaseDate(new DateTime('now'));
            $video->setUpcoming($videoData['is_upcoming']);
            $video->setImage($videoData['image']);
            foreach ($videoData['tags'] as $tagName) {
                $video->addTag($this->getReference('tag_' . $tagName));
            }
            $video->setCategory($this->getReference('category_' . $videoData['categorie']));
            $manager->persist($video);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TagFixtures::class
        ];
    }
}
