<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class TagFixtures extends Fixture implements DependentFixtureInterface
{
    public const TAGS = [
        ['name' => 'BANDES-ANNONCES', 'file' => 'gaming_house.jpg'],
        ['name' => 'DOCUMENTAIRES', 'file' => 'docu-categories.jpg'],
        ['name' => 'NOUVEAUTES', 'file' => 'new-categories.jpg'],
        ['name' => 'ESPORT', 'file' => 'esport-categories.jpg']
    ];

    public function __construct(private ParameterBagInterface $parameterBag, private SluggerInterface $slugger)
    {
    }


    public function load(ObjectManager $manager): void
    {
        $uploadImageDir = $this->parameterBag->get('image_dir');
        if (!is_dir(__DIR__ . '/../../public' . $uploadImageDir)) {
            mkdir(__DIR__ . '/../../public' . $uploadImageDir, recursive: true);
        }

        foreach (self::TAGS as $tagsData) {
            $tag = new Tag();
            $tag->setName($tagsData['name']);
            $this->addReference('tag_' . $tagsData['name'], $tag);

            // Définir le chemin d'accès au fichier
            $filePath = __DIR__ . '/data/images/' . $tagsData['file'];
            $destinationPath = __DIR__ . '/../../public' . $uploadImageDir . '/' . $tagsData
                ['file'];

            // Copier le fichier vers le répertoire de destination
            copy($filePath, $destinationPath);

            $tag->setFile($tagsData['file']);
            $tag->setSlug($this->slugger->slug($tagsData['name']));
            $manager->persist($tag);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
