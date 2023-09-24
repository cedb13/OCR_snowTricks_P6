<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Media;
use App\Entity\Trick;
use App\DataFixtures\TrickFixtures;

class MediaFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $tricks = $manager->getRepository(Trick::class)->findAll();//findAll trick objet, je récupère tous les objets tricks de ma base de donnée
        $medias = [
            [
                "title" => "Nose Grab", 
                "link" => "/images/tricks/nose-grab.jpg", 
                "type" =>  "image",
                "defaultImage" => 1,
            ],
            [
                "title" => "Backflip", 
                "link" => "/images/tricks/backflip.jpg", 
                "type" =>  "image",
                "defaultImage" => 1,
            ],
            [
                "title" => "The Mute Grab", 
                "link" => "/images/tricks/The-Mute-Grab.jpg", 
                "type" =>  "image",
                "defaultImage" => 1,
            ],
            [
                "title" => "Method Air Old School", 
                "link" => "/images/tricks/method-old-school.jpg", 
                "type" =>  "image",
                "defaultImage" => 1,
            ],
            [
                "title" => "Backside 180 Rotation",
                "link" => "/images/tricks/backside-180.jpg", 
                "type" =>  "image",
                "defaultImage" => 1,
            ],
            [
                "title" => "Stalefish Grab",
                "link" => "/images/tricks/Tricks-Stalefish-Grab.jpg", 
                "type" =>  "image",
                "defaultImage" => 1,
            ],
            [
                "title" => "Japan air Old School",
                "link" => "/images/tricks/Japan-air-old-school.jpg", 
                "type" =>  "image",
                "defaultImage" => 1,
            ],
            [
                "title" => "Decomposition Front flip", 
                "link" => "/images/tricks/deconposition-FrontFlip-snowboard.jpg", 
                "type" =>  "image",
                "defaultImage" => 1,
            ],
            [
                "title" => "Friedl Frontside", 
                "link" => "/images/tricks/friedl-fs-360.jpg", 
                "type" =>  "image",
                "defaultImage" => 1,
            ],
            [
                "title" => "World Championship Colorado Backside air", 
                "link" => "/images/tricks/LetItRide_CraigKelly_WorldChampionshipColorado_1990cJonFoster_Red_Bull_Content_Pool-620.jpg", 
                "type" =>  "image", 
                "defaultImage" => 1,
            ]

        ];

        foreach ($medias as $values) {

            $media = new Media();

            $title = $values["title"];
            $link = $values["link"];
            $type = $values["type"];
            $defaultImage = $values["defaultImage"];
            $trick = array_pop($tricks); //je récupère un objet du tableau tricks

            $media
                ->setTitle($title)
                ->setLink($link)
                ->setType($type)
                ->setDefaultImage($defaultImage)
                ->setTrick($trick);

            $manager->persist($media);
            
           

            $values = $media;
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            TrickFixtures::class,
        );
    }
}
