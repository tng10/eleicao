<?php

namespace Eleicao\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EleicaoSiteBundle:Default:index.html.twig');
    }
}
