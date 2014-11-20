<?php

namespace Eleicao\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VotacaoController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();

        $candidatos = $em->getRepository('EleicaoAdmBundle:Candidato')->findAll();

        $totalVotos = 0;
        foreach ($candidatos as $candidato) {
        	if (sizeof($candidato->getVotacoes()) == 1)
        		$totalVotos += $candidato->getVotacoes()[0]->getVotos();
        }

        return $this->render('EleicaoSiteBundle:Votacao:index.html.twig', array(
			'candidatos' => $candidatos,
			'totalVotos' => $totalVotos,
        ));
        
    }

    public function votarAction()
    {
    	$em = $this->getDoctrine()->getManager();

        $candidatos = $em->getRepository('EleicaoAdmBundle:Candidato')->findAll();

    	return $this->render('EleicaoSiteBundle:Votacao:votar.html.twig', array(
    		'candidatos' => $candidatos,
    	));
    }

    public function efetuarVotoAction($id)
    {
    	$em = $this->getDoctrine()->getManager();

        $candidato = $em->getRepository('EleicaoAdmBundle:Candidato')->find($id);

        if (sizeof($candidato->getVotacoes()) == 1)
        {
        	$votos = (int)$candidato->getVotacoes()[0]->getVotos() + 1;
        	$candidato->getVotacoes()[0]->setVotos($votos);

        	$em->persist($candidato);
            $em->flush();
        }

        $this->get('session')->getFlashBag()->add('notice', 'Seu voto foi computado com sucesso. Obrigado!');

    	return $this->redirect($this->generateUrl('site_votacao'));
    }


}
