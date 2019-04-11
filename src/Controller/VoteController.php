<?php

namespace App\Controller;

use App\Entity\Vote;
use App\Entity\Comment;
use App\Entity\SupportEntry;
use App\Entity\VoteEntry;
use App\Form\VoteType;
use App\Repository\VoteRepository;
use App\Repository\CommentRepository;
use App\Repository\SupportEntryRepository;
use App\Repository\VoteEntryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Validator\Tests\Fixtures\ToString;

/**
 * @Route("/vote")
 */
class VoteController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/", name="vote_index", methods={"GET"})
     */
    public function index(VoteRepository $voteRepository): Response
    {
        return $this->render('vote/index.html.twig', [
            'votes' => $voteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/propositions", name="vote_propositions", methods={"GET"})
     */
    public function propositions(VoteRepository $voteRepository): Response
    {
        return $this->render('vote/index_propositions.html.twig', [
            'votes' => $voteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/finished", name="vote_finished", methods={"GET"})
     */
    public function finished(VoteRepository $voteRepository): Response
    {
        return $this->render('vote/index_finished.html.twig', [
            'votes' => $voteRepository->findAll(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/new", name="vote_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $vote = new Vote();
        $form = $this->createForm(VoteType::class, $vote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            print($vote);
            $entityManager->persist($vote);
            $entityManager->flush();

            return $this->redirectToRoute('vote_index');
        }

        return $this->render('vote/new.html.twig', [
            'vote' => $vote,
            'form' => $form->createView()
        ]);
    }

    /**
     *
     * @Route("/{id}", name="vote_show", methods={"GET"})
     */
    public function show(Vote $vote, $id): Response
    {
        $commentRepository = $this->getDoctrine()->getRepository('App:Comment');
        $comments = $commentRepository->findBy(['voteID'=>$id]);

        try{
            $voteEntryRepository = $this->getDoctrine()->getRepository('App:VoteEntry');
            $voteCheck = $voteEntryRepository->findOneBy(['voteID'=>$id, 'author'=>$this->getUser()]);
            $opinion = $voteCheck->getOpinion();
            return $this->render('vote/show.html.twig', [
                'vote' => $vote,
                'user' => $this->getUser(),
                'userOpinion'=>$opinion,
                'comments'=>$comments

            ]);
        }catch(\Error $e){
            return $this->render('vote/show.html.twig', [
                'vote' => $vote,
                'user' => $this->getUser(),
                'comments'=>$comments
            ]);
        }


    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/{id}/edit", name="vote_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Vote $vote): Response
    {
        $form = $this->createForm(VoteType::class, $vote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vote_index', [
                'id' => $vote->getId(),
            ]);
        }

        return $this->render('vote/edit.html.twig', [
            'vote' => $vote,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/{id}", name="vote_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Vote $vote): Response
    {
        if ($this->isCsrfTokenValid('delete' . $vote->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vote);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vote_index');
    }





//

    /**
     *
     * @Route("/{id}/support", name="vote_support", methods={"GET"})
     */
    public function support(Vote $vote, $id): Response
    {
        // entity manager
        $em = $this->getDoctrine()->getManager();
        $voteRepository = $this->getDoctrine()->getRepository('App:Vote');
        $supportEntryRepository = $this->getDoctrine()->getRepository('App:SupportEntry');
        $userRepository = $this->getDoctrine()->getRepository('App:User');
        $commentRepository = $this->getDoctrine()->getRepository('App:Comment');
        $comments = $commentRepository->findBy(['voteID'=>$id]);

        //Check is support entry already exists
        $supportCheck = $supportEntryRepository->findBy(['vote'=>$id, 'author'=>$this->getUser()]);

        if($supportCheck == null)
        {
            //Create a support_entry
            $supportEntry = new SupportEntry($vote, $this->getUser());
            $em->persist($supportEntry);

            // find the vote with this ID
            $myVote = $voteRepository->find($id);
            $myVote->setSupporters($myVote->getSupporters()+1);

            $em->flush();
            return $this->render('vote/show.html.twig', [
                'vote' => $vote,
                'user' => $this->getUser(),
                'pageMessage'=>'Success! Thank you for your support on the vote!',
                'pageMessageType'=>'success',
                'comments'=>$comments

            ]);

        }else{
            return $this->render('vote/show.html.twig', [
                'vote' => $vote,
                'user' => $this->getUser(),
                'pageMessage'=>'Not possible! You cannot support a vote more than once.',
                'pageMessageType'=>'danger',
                'comments'=>$comments

            ]);
        }



        // actually executes the queries (i.e. the DELETE query)

        #return $this->redirectToRoute('vote_show', array('id'=>$id) );

    }


    /**
     *
     * @Route("/{id}/for", name="vote_for", methods={"GET"})
     */
    public function voteFor(Vote $vote, $id): Response
    {

        // entity manager
        $em = $this->getDoctrine()->getManager();
        $voteRepository = $this->getDoctrine()->getRepository('App:Vote');
        $voteEntryRepository = $this->getDoctrine()->getRepository('App:VoteEntry');
        $userRepository = $this->getDoctrine()->getRepository('App:User');
        $commentRepository = $this->getDoctrine()->getRepository('App:Comment');
        $comments = $commentRepository->findBy(['voteID'=>$id]);


        //Check is for entry already exists
        $voteCheck = $voteEntryRepository->findOneBy(['voteID'=>$id, 'author'=>$this->getUser()]);
        if($voteCheck == null)
        {
            //Create a vote_entry
            $voteEntry = new VoteEntry($vote, $this->getUser(), 1);

            $em->persist($voteEntry);

            // find the vote with this ID
            $myVote = $voteRepository->find($id);
            $myVote->setForCount($myVote->getForCount()+1);
            $em->flush();
            $voteCheck = $voteEntryRepository->findOneBy(['voteID'=>$id, 'author'=>$this->getUser()]);
            $opinion = $voteCheck->getOpinion();

            return $this->render('vote/show.html.twig', [
                'vote' => $vote,
                'user' => $this->getUser(),
                'pageMessage'=>'Success! Thank you for your vote!',
                'pageMessageType'=>'success',
                'userOpinion' => $opinion,
                'comments'=>$comments



            ]);

        }else{
            $opinion = $voteCheck->getOpinion();
            return $this->render('vote/show.html.twig', [
                'vote' => $vote,
                'user' => $this->getUser(),
                'pageMessage'=>'Not possible! You cannot vote again since you already voted!',
                'pageMessageType'=>'danger',
                'userOpinion' => $opinion,
                'comments'=>$comments

            ]);
        }



    }

    /**
     *
     * @Route("/{id}/against", name="vote_against", methods={"GET"})
     */
    public function voteAgainst(Vote $vote, $id): Response
    {
        // entity manager
        $em = $this->getDoctrine()->getManager();
        $voteRepository = $this->getDoctrine()->getRepository('App:Vote');
        $voteEntryRepository = $this->getDoctrine()->getRepository('App:VoteEntry');
        $commentRepository = $this->getDoctrine()->getRepository('App:Comment');
        $comments = $commentRepository->findBy(['voteID'=>$id]);

        //Check is against entry already exists
        $voteCheck = $voteEntryRepository->findOneBy(['voteID'=>$id, 'author'=>$this->getUser()]);

        if($voteCheck == null)
        {
            //Create a vote_entry
            $voteEntry = new VoteEntry($vote, $this->getUser(), 2); // 2 = against
            $em->persist($voteEntry);

            // find the vote with this ID
            $myVote = $voteRepository->find($id);
            $myVote->setAgainstCount($myVote->getAgainstCount()+1);
            $em->flush();

            return $this->render('vote/show.html.twig', [
                'vote' => $vote,
                'user' => $this->getUser(),
                'pageMessage'=>'Success! Thank you for your vote!',
                'pageMessageType'=>'success',
                'comments'=>$comments


            ]);

        }else{
            $opinion = $voteCheck->getOpinion();

            return $this->render('vote/show.html.twig', [
                'vote' => $vote,
                'user' => $this->getUser(),
                'pageMessage'=>'Not possible! You cannot vote again since you already voted!',
                'pageMessageType'=>'danger',
                'userOpinion' => $opinion,
                'comments'=>$comments

            ]);
        }
    }

    /**
     * @Route("/{id}/comment", name="comment_new", methods={"POST"})
     */
    public function commentNew(Request $request, $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $voteRepository = $this->getDoctrine()->getRepository('App:Vote');
        $myVote = $voteRepository->findOneBy(['id'=>$id]);
        $postData = $request->request->get('comment');

        $comment = new Comment();
        $comment->setDescription($postData);
        $comment->setAuthor($this->getUser());
        $comment->setVoteID($myVote);

        $entityManager->persist($comment);
        $entityManager->flush();

        return $this->redirectToRoute('vote_show',['id'=>$id]);



    }
}