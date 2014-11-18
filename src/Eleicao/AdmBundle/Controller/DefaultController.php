<?php

namespace Eleicao\AdmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EleicaoAdmBundle:Default:index.html.twig');
    }
}
