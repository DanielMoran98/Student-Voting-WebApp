<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Vote;
use App\Entity\VoteEntry;
use App\Entity\Comment;

class AppFixtures extends Fixture
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

        $vote1 = new Vote();
        $vote1->setTitle("Exams should start after easter");
        $vote1->setDescription("Exams should start after easter");
        $vote1->setImage("https://www.hera.org.nz/wp-content/uploads/20180412_Event_WeldingSupervisorExams_WELD-AM.jpg");
        $vote1->setAuthor($user);
        $vote1->setDateCreated(new \DateTime());
        $vote1->setState(0);
        $vote1->setForCount(0);
        $vote1->setAgainstCount(0);
        $manager->persist($vote1);

        $voteEntry1 = new voteEntry();
        $voteEntry1->setAuthor($user);
        $voteEntry1->setOpinion(1);
        $voteEntry1->setVoteID($vote1);
        $manager->persist($voteEntry1);

        $comment1 = new Comment();
        $comment1->setVoteID($vote1);
        $comment1->setAuthor($user);
        $comment1->setDescription("This is a comment");
        $manager->persist($comment1);



        $manager->flush();
    }
}
