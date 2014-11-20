<?php

namespace Eleicao\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PropostaController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EleicaoAdmBundle:Proposta')->findAll();

        return $this->render('EleicaoSiteBundle:Proposta:index.html.twig', array(
			'propostas' => $entities,
        ));
    }

}
