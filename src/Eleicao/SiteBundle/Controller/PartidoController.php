<?php

namespace Eleicao\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PartidoController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EleicaoAdmBundle:Partido')->findAll();

        return $this->render('EleicaoSiteBundle:Partido:index.html.twig', array(
			'partidos' => $entities,
        ));
    }

}
