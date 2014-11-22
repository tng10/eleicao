<?php

namespace Eleicao\AdmBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Eleicao\AdmBundle\Entity\Proposta;
use Eleicao\AdmBundle\Form\PropostaType;

/**
 * Proposta controller.
 *
 */
class PropostaController extends Controller
{

    /**
     * Lists all Proposta entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EleicaoAdmBundle:Proposta')->findAll();

        return $this->render('EleicaoAdmBundle:Proposta:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Proposta entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Proposta();
        $form = $this->createForm(new PropostaType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'Novo registro cadastrado com sucesso!');

            return $this->redirect($this->generateUrl('proposta_show', array('id' => $entity->getId())));
        }

        return $this->render('EleicaoAdmBundle:Proposta:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Proposta entity.
     *
     */
    public function newAction()
    {
        $entity = new Proposta();
        $form   = $this->createForm(new PropostaType(), $entity);

        return $this->render('EleicaoAdmBundle:Proposta:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Proposta entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EleicaoAdmBundle:Proposta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Não foi possível encontrar este proposta.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EleicaoAdmBundle:Proposta:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Proposta entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EleicaoAdmBundle:Proposta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Não foi possível encontrar este proposta.');
        }

        $editForm = $this->createForm(new PropostaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EleicaoAdmBundle:Proposta:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Proposta entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EleicaoAdmBundle:Proposta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Não foi possível encontrar este proposta.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PropostaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', 'Edição feita com sucesso!');

            return $this->redirect($this->generateUrl('proposta_show', array('id' => $id)));
        }

        return $this->render('EleicaoAdmBundle:Proposta:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Proposta entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EleicaoAdmBundle:Proposta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Não foi possível encontrar este proposta.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'Registro deletado com sucesso!');
        }

        return $this->redirect($this->generateUrl('proposta'));
    }

    /**
     * Creates a form to delete a Proposta entity by id.
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
