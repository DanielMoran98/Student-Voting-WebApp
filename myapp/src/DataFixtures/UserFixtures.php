<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new User();
        $user->setUsername("Dano");
        $user->setPassword("pass");
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        $user1 = new User();
        $user1->setUsername("Tom");
        $user1->setPassword("pass");
        $user1->setRoles(['ROLE_USER']);
        $manager->persist($user1);

        $manager->flush();
    }
}
