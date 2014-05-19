<?php

namespace ItesAC\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ItesAC\BackendBundle\Entity\Edificio;
use ItesAC\BackendBundle\Form\EdificioType;

/**
 * Edificio controller.
 *
 * @Route("/edificio")
 */
class EdificioController extends Controller
{

    /**
     * Lists all Edificio entities.
     *
     * @Route("/", name="edificio")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ItesACBackendBundle:Edificio')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Edificio entity.
     *
     * @Route("/", name="edificio_create")
     * @Method("POST")
     * @Template("ItesACBackendBundle:Edificio:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Edificio();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('edificio_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Edificio entity.
    *
    * @param Edificio $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Edificio $entity)
    {
        $form = $this->createForm(new EdificioType(), $entity, array(
            'action' => $this->generateUrl('edificio_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Edificio entity.
     *
     * @Route("/new", name="edificio_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Edificio();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Edificio entity.
     *
     * @Route("/{id}", name="edificio_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ItesACBackendBundle:Edificio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Edificio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Edificio entity.
     *
     * @Route("/{id}/edit", name="edificio_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ItesACBackendBundle:Edificio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Edificio entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Edificio entity.
    *
    * @param Edificio $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Edificio $entity)
    {
        $form = $this->createForm(new EdificioType(), $entity, array(
            'action' => $this->generateUrl('edificio_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Edificio entity.
     *
     * @Route("/{id}", name="edificio_update")
     * @Method("PUT")
     * @Template("ItesACBackendBundle:Edificio:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ItesACBackendBundle:Edificio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Edificio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('edificio_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Edificio entity.
     *
     * @Route("/{id}", name="edificio_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ItesACBackendBundle:Edificio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Edificio entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('edificio'));
    }

    /**
     * Creates a form to delete a Edificio entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('edificio_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
