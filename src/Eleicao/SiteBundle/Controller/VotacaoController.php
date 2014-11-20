<?php

namespace Eleicao\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VotacaoController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EleicaoAdmBundle:Candidato')->findAll();

        return $this->render('EleicaoSiteBundle:Votacao:index.html.twig', array(
			'candidatos' => $entities,
        ));
        
    }

}
