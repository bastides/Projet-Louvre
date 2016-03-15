<?php

namespace LOUVRE\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{
    public function homeAction()
    {
        return $this->render('LOUVREAppBundle:App:home.html.twig');
    }
}
