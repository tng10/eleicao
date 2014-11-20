<?php

namespace Eleicao\AdmBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Eleicao\AdmBundle\Entity\Partido;
use Eleicao\AdmBundle\Form\PartidoType;

/**
 * Partido controller.
 *
 */
class PartidoController extends Controller
{

    /**
     * Lists all Partido entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EleicaoAdmBundle:Partido')->findAll();

        return $this->render('EleicaoAdmBundle:Partido:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Partido entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Partido();
        $form = $this->createForm(new PartidoType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'Novo registro cadastrado com sucesso!');

            return $this->redirect($this->generateUrl('partido_show', array('id' => $entity->getId())));
        }

        return $this->render('EleicaoAdmBundle:Partido:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Partido entity.
     *
     */
    public function newAction()
    {
        $entity = new Partido();
        $form   = $this->createForm(new PartidoType(), $entity);

        return $this->render('EleicaoAdmBundle:Partido:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Partido entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EleicaoAdmBundle:Partido')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Não foi possível encontrar este partido.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EleicaoAdmBundle:Partido:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Partido entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EleicaoAdmBundle:Partido')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Não foi possível encontrar este partido.');
        }

        $editForm = $this->createForm(new PartidoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EleicaoAdmBundle:Partido:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Partido entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EleicaoAdmBundle:Partido')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Não foi possível encontrar este partido.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PartidoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', 'Edição feita com sucesso!');

            return $this->redirect($this->generateUrl('partido_edit', array('id' => $id)));
        }

        return $this->render('EleicaoAdmBundle:Partido:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Partido entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EleicaoAdmBundle:Partido')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Não foi possível encontrar este partido.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'Registro deletado com sucesso!');
        }

        return $this->redirect($this->generateUrl('partido'));
    }

    /**
     * Creates a form to delete a Partido entity by id.
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
