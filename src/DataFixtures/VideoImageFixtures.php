<?php

namespace App\DataFixtures;

use App\Entity\ImageVideo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class VideoImageFixtures extends Fixture
{
    public const IMAGES = [
        ['file' => 'clavier.jpg', 'video_name' => 'video_1'],
        ['file' => 'playstation_call_of_duty.jpg', 'video_name' => 'video_2'],
        ['file' => 'fifa_gameplay.jpg', 'video_name' => 'video_3'],
        ['file' => 'manette_league_of_legends.jpg', 'video_name' => 'video_4'],
        ['file' => 'gaming_house.jpg', 'video_name' => 'video_5'],
        ['file' => 'gameplay_pc.jpg', 'video_name' => 'video_6'],
        ['file' => 'League_of_legends.jpg', 'video_name' => 'video_7'],
        ['file' => 'manette_ps5.jpg', 'video_name' => 'video_8'],
    ];

    public function __construct(private ParameterBagInterface $parameterBag)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $uploadImageDir = $this->parameterBag->get('upload_image_dir');
        if (!is_dir(__DIR__ . '/../../public/' . $uploadImageDir)) {
            mkdir(__DIR__ . '/../../public/' . $uploadImageDir, recursive: true);
        }

        foreach (self::IMAGES as $imageData) {
            copy(
                __DIR__ . '/_data/images/' . $imageData['file'],
                __DIR__ . '/../../public' . $uploadImageDir . '/' . $imageData['file']
            );
            $image = new ImageVideo();
            $image->setFile($imageData['file']);
            $image->setVideo($this->getReference($imageData['video_name']));
            $manager->persist($image);
        }


        $manager->flush();
    }
}
