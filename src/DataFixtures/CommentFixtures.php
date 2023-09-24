<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Comment;
use App\Entity\Trick;
use App\Entity\User;
use App\DataFixtures\TrickFixtures;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $users = $manager->getRepository(USER::class)->findAll();
        $tricks = $manager->getRepository(Trick::class)->findAll();//findAll trick objet, je récupère tous les objets tricks de ma base de donnée
        $comments = [
            [
                "content" => "Nose Grab it's very fun", 
            ],
            [
                "content" => "Backflip", 
            ],
            [
                "content" => "The Mute Grab", 
            ],
            [
                "content" => "Method Air Old School", 
            ],
            [
                "content" => "Backside 180 Rotation",
            ],
            [
                "content" => "Stalefish Grab",
            ],
            [
                "content" => "Japan air Old School",
            ],
            [
                "content" => "Good decomposition Front flip", 
            ],
            [
                "content" => "Yoh! Frontside", 
            ],
            [
                "content" => "World Championship Colorado it's great", 
            ]            

        ];

        foreach ($comments as $values) {

            $comment = new Comment();

            $content = $values["content"];
            $user = array_pop($users); //je récupère un objet du tableau users
            $trick = array_pop($tricks); //je récupère un objet du tableau tricks

            $comment
                ->setContent($content)
                ->setCreatedAt(new \DateTime())
                ->setUser($user)
                ->setTrick($trick);

            $manager->persist($comment);
            
           

            $values = $comment;
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
