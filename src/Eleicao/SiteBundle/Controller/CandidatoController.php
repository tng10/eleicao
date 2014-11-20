<?php

namespace Eleicao\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CandidatoController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EleicaoAdmBundle:Candidato')->findAll();

        return $this->render('EleicaoSiteBundle:Candidato:index.html.twig', array(
			'candidatos' => $entities,
        ));
    }

}
