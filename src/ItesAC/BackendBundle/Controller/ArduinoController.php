<?php

namespace ItesAC\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ItesAC\BackendBundle\Entity\Arduino;
use ItesAC\BackendBundle\Form\ArduinoType;

/**
 * Arduino controller.
 *
 * @Route("/arduino")
 */
class ArduinoController extends Controller
{

    /**
     * Lists all Arduino entities.
     *
     * @Route("/", name="arduino")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ItesACBackendBundle:Arduino')->findAllWithEdificio();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Arduino entity.
     *
     * @Route("/", name="arduino_create")
     * @Method("POST")
     * @Template("ItesACBackendBundle:Arduino:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Arduino();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('arduino_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Arduino entity.
    *
    * @param Arduino $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Arduino $entity)
    {
        $form = $this->createForm(new ArduinoType(), $entity, array(
            'action' => $this->generateUrl('arduino_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Arduino entity.
     *
     * @Route("/new", name="arduino_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Arduino();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Arduino entity.
     *
     * @Route("/{id}", name="arduino_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ItesACBackendBundle:Arduino')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Arduino entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Arduino entity.
     *
     * @Route("/{id}/edit", name="arduino_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ItesACBackendBundle:Arduino')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Arduino entity.');
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
    * Creates a form to edit a Arduino entity.
    *
    * @param Arduino $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Arduino $entity)
    {
        $form = $this->createForm(new ArduinoType(), $entity, array(
            'action' => $this->generateUrl('arduino_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Arduino entity.
     *
     * @Route("/{id}", name="arduino_update")
     * @Method("PUT")
     * @Template("ItesACBackendBundle:Arduino:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ItesACBackendBundle:Arduino')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Arduino entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('arduino_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Arduino entity.
     *
     * @Route("/{id}", name="arduino_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ItesACBackendBundle:Arduino')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Arduino entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('arduino'));
    }

    /**
     * Creates a form to delete a Arduino entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('arduino_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
