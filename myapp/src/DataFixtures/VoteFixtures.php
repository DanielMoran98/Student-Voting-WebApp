<?php

namespace App\DataFixtures;

use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Vote;

class VoteFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        //$userRepository = new UserRepository();

//        $vote1 = new Vote();
//        $vote1->setTitle("Exams should start after easter");
//        $vote1->setDescription("Exams should start after easter");
//        $vote1->setImage("https://www.hera.org.nz/wp-content/uploads/20180412_Event_WeldingSupervisorExams_WELD-AM.jpg");
//        $vote1->setAuthor("Dano");
//        $vote1->setDateCreated(new \DateTime());
//        $vote1->setState(0);

        $manager->flush();
    }
}
