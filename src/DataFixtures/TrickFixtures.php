<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Repository\TrickRepository;
use App\Entity\Trick;
use App\Entity\User;
use App\DataFixtures\UserFixtures;

class TrickFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $trick1 = new Trick();
        
        $str1 = 'Backside Air';
        $slug1 = TrickRepository::slug($str1);
        $category1 = 'Old school';
        $content1 = "On parle de backside pour qualifier une rotation d'un athlète. Cela veut dire que le planchiste a commencé sa rotation dos au landing lorsqu il a décollé du big air.";
        $id = 4;
        $user1 = $manager->getRepository(User::class)->find($id);

        $trick1->setName($str1);
        $trick1->setSlug($slug1);
        $trick1->setCategory($category1);
        $trick1->setContent($content1);
        $trick1->setCreatedAt(new \DateTime());
        $trick1->setUpdatedAt(null);
        $trick1->setUser($user1);
        $manager->persist($trick1);
        $this->addReference('trick1', $trick1);

       $trick2 = new Trick();
        
        $str2 = 'FrontSide 360';
        $slug2 = TrickRepository::slug($str2);
        $category2 = 'Rotations';
        $content2 = "On parle de frontside pour qualifier une rotation d'un athlète. Cela veut dire que le planchiste a commencé sa rotation face au landing lorsqu'il a décollé du big air. Pour un regular, un frontside spin tourne vers la gauche, alors que pour le goofy, il tournera vers la droite.";
        $id = 3;
        $user2 = $manager->getRepository(User::class)->find($id);

        $trick2->setName($str2);
        $trick2->setSlug($slug2);
        $trick2->setCategory($category2);
        $trick2->setContent($content2);
        $trick2->setCreatedAt(new \DateTime());
        $trick2->setUpdatedAt(null);
        $trick2->setUser($user2);
        $manager->persist($trick2);
        $this->addReference('trick2', $trick2);

        $trick3 = new Trick();
        
        $str3 = 'Front flip';
        $slug3 = TrickRepository::slug($str3);
        $category3 = 'Flips';
        $content3 = "Un flip est une rotation verticale. Les front flips sont des rotations en avant.";
        $id = 5;
        $user3 = $manager->getRepository(User::class)->find($id);
        //$user3 = $this->getReference('userName'.mt_rand(0, 7));

        $trick3->setName($str3);
        $trick3->setSlug($slug3);
        $trick3->setCategory($category3);
        $trick3->setContent($content3);
        $trick3->setCreatedAt(new \DateTime());
        $trick3->setUpdatedAt(null);
        $trick3->setUser($user3);
        $manager->persist($trick3);
        $this->addReference('trick3', $trick3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
