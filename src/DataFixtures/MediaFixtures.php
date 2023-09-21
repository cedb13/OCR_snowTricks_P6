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
                "title" => "Decomposition Front flip", 
                "link" => "/images/tricks/deconposition-FrontFlip-snowboard.jpg", 
                "type" =>  "image",
            ],
            [
                "title" => "Friedl Frontside", 
                "link" => "/images/tricks/friedl-fs-360.jpg", 
                "type" =>  "image",
            ],
            [
                "title" => "World Championship Colorado", 
                "link" => "/images/tricks/LetItRide_CraigKelly_WorldChampionshipColorado_1990cJonFoster_Red_Bull_Content_Pool-620.jpg", 
                "type" =>  "image", 
            ]

        ];

        foreach ($medias as $values) {

            $media = new Media();

            $title = $values["title"];
            $link = $values["link"];
            $type = $values["type"];
            $trick = array_pop($tricks); //je récupère un objet du tableau tricks

            $media
                ->setTitle($title)
                ->setLink($link)
                ->setType($type)
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
