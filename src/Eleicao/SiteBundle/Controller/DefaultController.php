<?php

namespace Eleicao\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $partidos = $em->getRepository('EleicaoAdmBundle:Partido')->findAll();
        $candidatos = $em->getRepository('EleicaoAdmBundle:Candidato')->findAll();
        $propostas = $em->getRepository('EleicaoAdmBundle:Proposta')->findAll();

        return $this->render('EleicaoSiteBundle:Default:index.html.twig', array(
			'partidos' => $partidos,
			'candidatos' => $candidatos,
			'propostas' => $propostas,
        ));    
    }
}
