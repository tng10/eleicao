<?php

namespace Eleicao\AdmBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Eleicao\AdmBundle\Entity\Candidato;
use Eleicao\AdmBundle\Entity\Votacao;
use Eleicao\AdmBundle\Form\CandidatoType;

/**
 * Candidato controller.
 *
 */
class CandidatoController extends Controller
{

    /**
     * Lists all Candidato entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EleicaoAdmBundle:Candidato')->findAll();

        return $this->render('EleicaoAdmBundle:Candidato:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Candidato entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Candidato();
        $form = $this->createForm(new CandidatoType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $entities = $em->getRepository('EleicaoAdmBundle:Candidato')->findBy(array('partido' => $entity->getPartido()));
            if ($entities)
            {
                $this->get('session')->getFlashBag()->add('notice', 'Não foi possível cadastrar, pois já existe um candidato vinculado a este partido!');
                return $this->redirect($this->generateUrl('candidato'));
            }

            $imagem = $form['imagem']->getData();

            if ($imagem)
            {
                $imagem = $editForm['imagem']->getData();
                $ext = $imagem->getClientOriginalExtension();
                $nomeImagem = md5($imagem->getPathName()).'.'.$ext;
                $imagem->move('uploads', $nomeImagem);
                $entity->setImagem($nomeImagem);
            }            
            
            $em->persist($entity);
            $em->flush();

            $votacao = new Votacao();
            $votacao->setVotos(0);
            $votacao->setCandidato($entity);

            $entity->addVotacao($votacao);

            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'Novo registro cadastrado com sucesso!');

            return $this->redirect($this->generateUrl('candidato_show', array('id' => $entity->getId())));
        }

        return $this->render('EleicaoAdmBundle:Candidato:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Candidato entity.
     *
     */
    public function newAction()
    {
        $entity = new Candidato();
        $form   = $this->createForm(new CandidatoType(), $entity);

        return $this->render('EleicaoAdmBundle:Candidato:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Candidato entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EleicaoAdmBundle:Candidato')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Não foi possível encontrar este candidato.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EleicaoAdmBundle:Candidato:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),      
        ));
    }

    /**
     * Displays a form to edit an existing Candidato entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EleicaoAdmBundle:Candidato')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Não foi possível encontrar este candidato.');
        }

        $editForm = $this->createForm(new CandidatoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EleicaoAdmBundle:Candidato:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Candidato entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EleicaoAdmBundle:Candidato')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Não foi possível encontrar este candidato.');
        }

        $nomeImagemAtual = $entity->getImagem();

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CandidatoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {

            $entities = $em->getRepository('EleicaoAdmBundle:Candidato')->findBy(array('partido' => $entity->getPartido()));
            if ($entities)
            {
                $this->get('session')->getFlashBag()->add('notice', 'Não foi possível editar, pois já existe um candidato vinculado a este partido!');
                return $this->redirect($this->generateUrl('candidato'));
            }

            if ($nomeImagemAtual != $entity->getImagem())
            {
            
                $imagem = $editForm['imagem']->getData();

                if ($imagem)
                {
                    $imagem = $editForm['imagem']->getData();
                    $ext = $imagem->getClientOriginalExtension();
                    $nomeImagem = md5($imagem->getPathName()).'.'.$ext;
                    $imagem->move('uploads', $nomeImagem);
                    $entity->setImagem($nomeImagem);

                    $uploads = $this->get('kernel')->getRootDir().'/../web/uploads/';
                    @unlink($uploads.$nomeImagemAtual);
                }
                else
                {
                    $entity->setImagem($nomeImagemAtual);                    
                }
            }

            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', 'Edição feita com sucesso!');

            return $this->redirect($this->generateUrl('candidato_show', array('id' => $id)));
        }

        return $this->render('EleicaoAdmBundle:Candidato:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Candidato entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EleicaoAdmBundle:Candidato')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Não foi possível encontrar este candidato.');
            }

            $nomeImagem = $entity->getImagem();

            $em->remove($entity);
            $em->flush();

            $uploads = $this->get('kernel')->getRootDir().'/../web/uploads/';
            @unlink($uploads.$nomeImagem);

            $this->get('session')->getFlashBag()->add('notice', 'Registro deletado com sucesso!');
        }

        return $this->redirect($this->generateUrl('candidato'));
    }

    /**
     * Creates a form to delete a Candidato entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
