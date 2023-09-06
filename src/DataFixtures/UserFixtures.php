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
        for ($i=0; $i<8; $i++)
        {
            $user = new User();
        
            $userName = 'userName' . $i;
            $user->setUserName($userName);
            $email = $userName.'@exemple.com';
            $user->setEmail($email);
            $user->setRoles($roles);
            $password = $this->hasher->hashPassword($user, '@Test123#'. $i);
            $user->setPassword($password);
            $avatarFile = '/images/avatars/avatar-'.$userName.'png';
            $user->setUserLinkPhoto($avatarFile);

            $manager->persist($user);

            $this->addReference($i, $user);
        }

        $manager->flush();
    }
}
