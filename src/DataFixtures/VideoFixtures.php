<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class VideoFixtures extends Fixture
{
    public const VIDEOS = [
        ['title' => 'Gameplay clavier', 'time' => 9, 'video_url' => 'clavier.mp4', 'views' => 5,
            'is_private' => false, 'is_upcoming' => true, 'video_number' => '1', 'image' => 'clavier.jpg'],
        ['title' => 'Gameplay call of duty ps4', 'time' => 31, 'video_url' => 'gameplay_call_of_duty.mp4',
            'views' => 25, 'is_private' => false, 'is_upcoming' => true, 'video_number' => '2',
            'image' => 'playstation_call_of_duty.jpg'],
        ['title' => 'Gameplay fifa', 'time' => 10, 'video_url' => 'gameplay_fifa.mp4', 'views' => 11,
            'is_private' => false, 'is_upcoming' => true, 'video_number' => '3', 'image' => 'fifa_gameplay.jpg'],
        ['title' => 'League of Legends à la manette', 'time' => 39,
            'video_url' => 'gameplay_manette_league_of_legend.mp4',
            'views' => 29, 'is_private' => false, 'is_upcoming' => true, 'video_number' => '4',
            'image' => 'manette_league_of_legends.jpg'],
        ['title' => 'Gaming house', 'time' => 18, 'video_url' => 'gaming_house.mp4', 'views' => 5,
            'is_private' => true, 'is_upcoming' => true, 'video_number' => '5', 'image' => 'gaming_house.jpg'],
        ['title' => 'Gameplay jeux pc', 'time' => 27, 'video_url' => 'gameplay.mp4', 'views' => 9,
            'is_private' => true, 'is_upcoming' => true, 'video_number' => '6', 'image' => 'gameplay_pc.jpg'],
        ['title' => 'League of Legends', 'time' => 6, 'video_url' => 'league_of_legends.mp4', 'views' => 2,
            'is_private' => true, 'is_upcoming' => true, 'video_number' => '7', 'image' => 'League_of_legends.jpg'],
        ['title' => 'Gameplay manette ps5', 'time' => 14, 'video_url' => 'manette_ps5.mp4', 'views' => 12,
            'is_private' => true, 'is_upcoming' => true, 'video_number' => '8', 'image' => 'manette_ps5.jpg'],
    ];

    public function __construct(private ParameterBagInterface $parameterBag)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $uploadVideoDir = $this->parameterBag->get('video_dir');
        if (!is_dir(__DIR__ . '/../../public/' . $uploadVideoDir)) {
            mkdir(__DIR__ . '/../../public/' . $uploadVideoDir, recursive: true);
        }

        $uploadImageDir = $this->parameterBag->get('image_dir');
        if (!is_dir(__DIR__ . '/../../public/' . $uploadImageDir)) {
            mkdir(__DIR__ . '/../../public/' . $uploadImageDir, recursive: true);
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
            $manager->persist($video);
        }
        $manager->flush();
    }
}
