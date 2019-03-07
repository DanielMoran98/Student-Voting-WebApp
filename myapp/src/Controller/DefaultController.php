<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default_index")
     */
    public function index()
    {
        $template = 'default/index.html.twig';
        $args = ['controller_name' => 'DefaultController'];
        return $this->render($template,$args);
    }
}
