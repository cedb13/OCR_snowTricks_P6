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
