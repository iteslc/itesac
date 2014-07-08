<?php

namespace ItesAC\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use ItesAC\BackendBundle\Entity\Planta;
use ItesAC\BackendBundle\Form\PlantaType;

/**
 * Planta controller.
 *
 * @Route("/planta")
 */
class PlantaController extends Controller
{

    /**
     * Lists all Planta entities.
     *
     * @Route("/", name="planta")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ItesACBackendBundle:Planta')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Planta entity.
     *
     * @Route("/", name="planta_create")
     * @Method("POST")
     * @Template("ItesACBackendBundle:Planta:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Planta();
        $form = $this->createCreateForm($entity,$request->isXmlHttpRequest());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('planta_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Planta entity.
    *
    * @param Planta $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Planta $entity, $isAjax)
    {
        $form = $this->createForm(new PlantaType(), $entity, array(
            'action' => $this->generateUrl('planta_create'),
            'method' => 'POST',
            'ajax'  => $isAjax,
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Planta entity.
     *
     * @Route("/new", name="planta_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Planta();
        $form   = $this->createCreateForm($entity,false);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Planta entity.
     *
     * @Route("/{id}", name="planta_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ItesACBackendBundle:Planta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Planta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Planta entity.
     *
     * @Route("/{id}/edit", name="planta_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ItesACBackendBundle:Planta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Planta entity.');
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
    * Creates a form to edit a Planta entity.
    *
    * @param Planta $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Planta $entity, $isAjax)
    {
        $form = $this->createForm(new PlantaType(), $entity, array(
            'action' => $this->generateUrl('planta_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'ajax' => $isAjax,
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Planta entity.
     *
     * @Route("/{id}", name="planta_update")
     * @Method("PUT")
     * @Template("ItesACBackendBundle:Planta:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ItesACBackendBundle:Planta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Planta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity,$request->isXmlHttpRequest());
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('planta_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Planta entity.
     *
     * @Route("/{id}", name="planta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ItesACBackendBundle:Planta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Planta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('planta'));
    }

    /**
     * Creates a form to delete a Planta entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('planta_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    /**
     * get an image of the respective plant.
     *
     * @Route("/image/{id}", name="planta_image")
     * @ParamConverter("planta", class="ItesACBackendBundle:Planta")
     * @Method("GET")
     * @Template()
     */
    public function imageAction(Request $request,Planta $planta)
    {
        if(!$request->isXmlHttpRequest()){
            throw $this->createNotFoundException();
        }
        
        return array(
            'planta' => $planta,
        );
    }
}
