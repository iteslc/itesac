<?php

namespace ItesAC\ControlBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use ItesAC\BackendBundle\Entity\Planta;

/**
 * Control controller
 *
 * @author Dany Cast
 *
 * @Route("/control")
 */
class ControlController extends Controller
{
    /**
     * List all edificios in the institution
     *
     * @Route("/", name="institution")
     * @Method("GET")
     * @Template()
     */
    public function institutionAction()
    {
        $em = $this->getDoctrine()->getManager();

        $edificios = $em->getRepository('ItesACBackendBundle:Edificio')->findAll();

        return array(
            'edificios' => $edificios,
        );
    }
    /**
     * List all ac in the planta
     *
     * @Route("/planta/{id}", name="control_planta")
     * @ParamConverter("planta", class="ItesACBackendBundle:Planta")
     * @Method("GET")
     * @Template()
     */
    public function plantaAction(Planta $planta)
    {
        return array(
            'planta' => $planta,
        );
    }

}
