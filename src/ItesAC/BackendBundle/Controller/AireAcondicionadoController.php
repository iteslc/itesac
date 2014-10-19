<?php

namespace ItesAC\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ItesAC\BackendBundle\Entity\AireAcondicionado;
use ItesAC\BackendBundle\Form\AireAcondicionadoType;

/**
 * AireAcondicionado controller.
 *
 * @Route("/ac")
 */
class AireAcondicionadoController extends Controller
{

    /**
     * Lists all AireAcondicionado entities.
     *
     * @Route("/", name="ac")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ItesACBackendBundle:AireAcondicionado')->findAllWithJoins();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new AireAcondicionado entity.
     *
     * @Route("/", name="ac_create")
     * @Method("POST")
     * @Template("ItesACBackendBundle:AireAcondicionado:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new AireAcondicionado();
        $form = $this->createCreateForm($entity,$request->isXmlHttpRequest());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ac_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a AireAcondicionado entity.
    *
    * @param AireAcondicionado $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(AireAcondicionado $entity, $isAjax)
    {
        $form = $this->createForm(new AireAcondicionadoType(), $entity, array(
            'action' => $this->generateUrl('ac_create'),
            'method' => 'POST',
            'ajax'  => $isAjax,
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new AireAcondicionado entity.
     *
     * @Route("/new", name="ac_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new AireAcondicionado();
        $form   = $this->createCreateForm($entity,false);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a AireAcondicionado entity.
     *
     * @Route("/{id}", name="ac_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ItesACBackendBundle:AireAcondicionado')->findByIdWithPlanta($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AireAcondicionado entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing AireAcondicionado entity.
     *
     * @Route("/{id}/edit", name="ac_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ItesACBackendBundle:AireAcondicionado')->findByIdWithJoins($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AireAcondicionado entity.');
        }

        $editForm = $this->createEditForm($entity,false);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a AireAcondicionado entity.
    *
    * @param AireAcondicionado $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(AireAcondicionado $entity, $isAjax)
    {
        $form = $this->createForm(new AireAcondicionadoType(), $entity, array(
            'action' => $this->generateUrl('ac_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'ajax' => $isAjax,
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing AireAcondicionado entity.
     *
     * @Route("/{id}", name="ac_update")
     * @Method("PUT")
     * @Template("ItesACBackendBundle:AireAcondicionado:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ItesACBackendBundle:AireAcondicionado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AireAcondicionado entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity,$request->isXmlHttpRequest());
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ac_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a AireAcondicionado entity.
     *
     * @Route("/{id}", name="ac_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ItesACBackendBundle:AireAcondicionado')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AireAcondicionado entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ac'));
    }

    /**
     * Creates a form to delete a AireAcondicionado entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ac_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
