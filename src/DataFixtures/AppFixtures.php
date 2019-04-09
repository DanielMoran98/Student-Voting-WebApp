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

        //USERS
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


        //VOTES
        $vote1 = new Vote();
        $vote1->setTitle("Exams should start after easter");
        $vote1->setDescription("Exams should start after easter");
        $vote1->setImage("https://www.hera.org.nz/wp-content/uploads/20180412_Event_WeldingSupervisorExams_WELD-AM.jpg");
        $vote1->setAuthor($user);
        $vote1->setDateCreated(new \DateTime());
        $vote1->setSupporters(49);
        $manager->persist($vote1);

        $vote2 = new Vote();
        $vote2->setTitle("Allow first years to run for Student Union President");
        $vote2->setDescription("We believe this will give us a wider pool to select a Student Union president from allowing us to elect a president thats of high quality.");
        $vote2->setImage("http://t7news.in/wp-content/uploads/2018/05/Social-Media-Marketing-Political-Election-Campaign-Propaganda.jpg");
        $vote2->setAuthor($user1);
        $vote2->setDateCreated(new \DateTime());
        $vote2->setSupporters(35);
        $manager->persist($vote2);

        $vote3 = new Vote();
        $vote3->setTitle("Redo entire canteen menu");
        $vote3->setDescription("Students believe the lack of affordable healthy food in the canteen is concerning and needs changing.");
        $vote3->setImage("https://st2.depositphotos.com/8072304/11806/i/950/depositphotos_118067248-stock-photo-school-lunch-box-with-sandwich.jpg");
        $vote3->setAuthor($user);
        $vote3->setDateCreated(new \DateTime());
        $vote3->setSupporters(51);
        $manager->persist($vote3);

        $vote4 = new Vote();
        $vote4->setTitle("Open library on sundays");
        $vote4->setDescription("Opening the library on Sundays will allow students to have a place to study in peace.");
        $vote4->setImage("https://library.itb.ie/wp-content/uploads/2018/04/Get-Help-ITB-Library.jpg");
        $vote4->setAuthor($user1);
        $vote4->setDateCreated(new \DateTime());
        $vote4->setSupporters(65);
        $vote4->setForCount(75);
        $vote4->setAgainstCount(25);
        $vote4->setState(0);
        $manager->persist($vote4);


        //VOTE ENTRIES
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
