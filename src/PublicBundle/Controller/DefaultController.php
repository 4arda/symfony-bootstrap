<?php

namespace PublicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="public.homepage")
     */
    public function indexAction()
    {
        return $this->render('PublicBundle:Default:index.html.twig');
    }
}
