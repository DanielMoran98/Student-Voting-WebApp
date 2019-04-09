<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PollController extends AbstractController
{

    /**
     * @Route("/poll", name="poll")
     */
    public function index() //Displays a list of active polls
    {
        $template = 'poll/index.html.twig';
        $args = ['controller_name' => 'DefaultController'];
        return $this->render($template,$args);
    }

    /**
     * @Route("/poll/{ID}", name="poll_show")
     */
    public function show() //Displays a list of active polls
    {
        $template = 'poll/index.html.twig';
        $args = ['controller_name' => 'DefaultController'];
        return $this->render($template,$args);
    }
}
