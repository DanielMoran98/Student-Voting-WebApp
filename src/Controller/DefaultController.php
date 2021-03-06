<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


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

    /**
     * @Route("/about", name="default_about")
     */
    public function about()
    {
        $template = 'default/index.html.twig';
        $args = ['controller_name' => 'DefaultController'];
        return $this->render($template,$args);
    }


}
