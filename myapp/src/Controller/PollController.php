<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PollController extends AbstractController
{
    /**
     * @Route("/poll", name="poll")
     */
    public function index()
    {
        return $this->render('poll/index.html.twig', [
            'controller_name' => 'PollController',
        ]);
    }
}
