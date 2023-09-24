<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
        $roles[] = 'ROLE_ADMIN';
        for ($i=1; $i<11; $i++)
        {
            $user = new User();

            $userName = 'userName' . $i;
            $email = $userName.'@exemple.com';
            $password = $this->hasher->hashPassword($user, '@Test123#'. $i);
            $avatarFile = '/images/avatars/avatar-'.$userName.'.png';
            
            $user
                ->setUserName($userName)
                ->setEmail($email)
                ->setRoles($roles)
                ->setPassword($password)
                ->setUserLinkPhoto($avatarFile);

                $manager->persist($user);
                $this->addReference($i, $user);

            

            
            //dd($this->getReference('user'.$i, $user));
        }

        $manager->flush();
    }

    public function getOrder() 
    {
        return 0; // Load before tricks
    }
}
