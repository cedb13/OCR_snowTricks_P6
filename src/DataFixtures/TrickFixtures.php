<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Repository\TrickRepository;
use App\Entity\Trick;
use App\Entity\User;
use App\DataFixtures\UserFixtures;
use PhpParser\Node\Expr\Cast\Array_;

class TrickFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $users = $manager->getRepository(USER::class)->findAll();
        $tricks = [
            [
                "name" => "Backside Air", 
                "category" => "Old school", 
                "content" =>  "On parle de backside pour qualifier une rotation d'un athlète. Cela veut dire que le planchiste a commencé sa rotation dos au landing lorsqu il a décollé du big air.", 
            ],
            [
                "name" => "FrontSide 360", 
                "category" => "Rotations", 
                "content" =>  "On parle de frontside pour qualifier une rotation d'un athlète. Cela veut dire que le planchiste a commencé sa rotation face au landing lorsqu'il a décollé du big air. Pour un regular, un frontside spin tourne vers la gauche, alors que pour le goofy, il tournera vers la droite.", 
            ],
            [
                "name" => "Front flip", 
                "category" => "Flips", 
                "content" =>  "Un flip est une rotation verticale. Les front flips sont des rotations en avant.", 
            ],
            [
                "name" => "Japan air", 
                "category" => "Old school", 
                "content" => "saisie de l'avant de la planche, avec la main avant, du côté de la carre frontside",
            ],
            [
                "name" => "stalefish", 
                "category" => "Grabs", 
                "content" => "saisie de la carre backside de la planche entre les deux pieds avec la main arrière.",
            ],  
            [
                "name" => "Backside 180", 
                "category" => "Rotations", 
                "content" => "Désigne un demi-tour, soit 180 degrés d'angle ou le planchiste a commencé sa rotation dos au landing lorsqu'il a décollé.",
            ],
                
            [
                "name" => "Method Air", 
                "category" => "Old school", 
                "content" => "Passe la main avant derrière ton genou et étends tes jambes de façon à ce que ton corps ait presque la forme de la queue d'un scorpion, puis cherche à atteindre le ciel avec ta main arrière.",
            ],
            [
                "name" => "Mute",
                "category" => "Grabs", 
                "content" => "Saisie de la carre frontside de la planche entre les deux pieds avec la main avant.",
            ],
            [
                "name" => "Back flip" , 
                "category" => "Flips", 
                "content" => "Un Backflip fait tourner la planche perpendiculairement à la neige, tu fais donc un Flip directement en arrière, en stabilisant la planche lors de l'atterrissage.",
            ],
            [
                "name" => "nose grab" , 
                "category" => "Grabs", 
                "content" =>  "Saisie de la partie avant de la planche, avec la main avant.",
            ]
        ];

        foreach ($tricks as $values) {
            $trick = new Trick();

            $name = $values["name"];
            $slug = TrickRepository::slug($name);
            $category = $values["category"];
            $content = $values["content"];
            $user = array_pop($users);


            $trick
                ->setName($name)
                ->setSlug($slug)
                ->setCategory($category)
                ->setContent($content)
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(null)
                ->setUser($user);

            $manager->persist($trick);
            
            $values = $trick;
            
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
    public function getOrder() 
    {
        return 1; // Load after user
   }
}
