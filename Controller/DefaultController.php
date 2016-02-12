<?php

namespace Olousouzian\AkitaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OlousouzianAkitaBundle:Default:index.html.twig');
    }
}
