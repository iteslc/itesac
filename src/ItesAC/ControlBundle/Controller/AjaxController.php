<?php

namespace ItesAC\ControlBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ItesAC\ControlBundle\Manager\ACManager;
use ItesAC\BackendBundle\Entity\Edificio;
use ItesAC\BackendBundle\Entity\Planta;
use ItesAC\BackendBundle\Entity\AireAcondicionado;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Receive all ajax calls
 *
 * @author Dany Cast
 *
 * @Route("/control")
 */
class AjaxController extends Controller
{
    /**
     * Turns on all ac in the institution
     * 
     * @Route("/all/on", name="control_all_on")
     * @Method("GET")
     */
    public function turnOnAllAction(Request $request)
    {
        if(!$request->isXmlHttpRequest()){
            throw $this->createNotFoundException();
        }
        //obtendra todos los ac
        $em = $this->getDoctrine()->getManager();
        $aires = $em->getRepository('ItesACBackendBundle:AireAcondicionado')->findAll();
        
        $acs=new ArrayCollection();
        //checara cada uno su estado
        foreach ($aires as $ac) {
            if(!ACManager::checkAC($ac)){
                $acs->add($ac);
            }
        }
        //si esta apagado los pondra en un arreglo
        //y enviara el arreglo al templete
    }
    /**
     * Turns off all ac in the institution
     * 
     * @Route("/all/off", name="control_all_off")
     * @Method("GET")
     */
    public function turnOffAllAction(Request $request)
    {
        if(!$request->isXmlHttpRequest()){
            throw $this->createNotFoundException();
        }
        //llamara todos los aires 
        //los apagara
    }
    /**
     * Turns on all ac in the edificio
     * 
     * @Route("/edificio/{id}/on", name="control_edificio_on")
     * @ParamConverter("edificio", class="ItesACBackendBundle:Edificio")
     * @Method("GET")
     */
    public function turnOnEdificioAction(Request $request,Edificio $edificio)
    {
        if(!$request->isXmlHttpRequest()){
            throw $this->createNotFoundException();
        }
    }
    /**
     * Turns off all ac in the edificio
     * 
     * @Route("/edificio/{id}/off", name="control_edificio_off")
     * @ParamConverter("edificio", class="ItesACBackendBundle:Edificio")
     * @Method("GET")
     */
    public function turnOffEdificioAction(Request $request, Edificio $edificio)
    {
        if(!$request->isXmlHttpRequest()){
            throw $this->createNotFoundException();
        }
    }
    /**
     * Checks status of all ac in the edificio
     * 
     * @Route("/edificio/{id}/check", name="control_edificio_check")
     * @ParamConverter("edificio", class="ItesACBackendBundle:Edificio")
     * @Method("GET")
     * @Template()
     */
    public function checkEdificioAction(Request $request, Edificio $edificio)
    {
        if(!$request->isXmlHttpRequest()){
            throw $this->createNotFoundException();
        }
    }
    /**
     * Turns on all ac in the planta
     * 
     * @Route("/planta/{id}/on", name="control_planta_on")
     * @ParamConverter("planta", class="ItesACBackendBundle:Planta")
     * @Method("GET")
     */
    public function turnOnPlantaAction(Request $request,Planta $planta)
    {
        if(!$request->isXmlHttpRequest()){
            throw $this->createNotFoundException();
        }
    }
    /**
     * Turns off all ac in the planta
     * 
     * @Route("/planta/{id}/off", name="control_planta_off")
     * @ParamConverter("planta", class="ItesACBackendBundle:Planta")
     * @Method("GET")
     */
    public function turnOffPlantaAction(Request $request, Planta $planta)
    {
        if(!$request->isXmlHttpRequest()){
            throw $this->createNotFoundException();
        }
    }
    /**
     * Checks status of all ac in the planta
     * 
     * @Route("/planta/{id}/check", name="control_planta_check")
     * @ParamConverter("planta", class="ItesACBackendBundle:Planta")
     * @Method("GET")
     * @Template()
     */
    public function checkPlantaAction(Request $request, Planta $planta)
    {
        if(!$request->isXmlHttpRequest()){
            throw $this->createNotFoundException();
        }
    }
    /**
     * Turns on ac
     * 
     * @Route("/ac/{id}/on", name="control_ac_on")
     * @ParamConverter("ac", class="ItesACBackendBundle:AireAcondicionado")
     * @Method("GET")
     */
    public function turnOnACAction(Request $request, AireAcondicionado $ac)
    {
        if(!$request->isXmlHttpRequest()){
            throw $this->createNotFoundException();
        }
    }
    /**
     * Turns off ac
     * 
     * @Route("/ac/{id}/off", name="control_ac_off")
     * @ParamConverter("ac", class="ItesACBackendBundle:AireAcondicionado")
     * @Method("GET")
     */
    public function turnOffACAction(Request $request, AireAcondicionado $ac)
    {
        if(!$request->isXmlHttpRequest()){
            throw $this->createNotFoundException();
        }
    }
    /**
     * Checks ac's status
     * 
     * @Route("/ac/{id}/check", name="control_ac_check")
     * @ParamConverter("ac", class="ItesACBackendBundle:AireAcondicionado")
     * @Method("GET")
     * @Template()
     */
    public function checkACAction(Request $request, AireAcondicionado $ac)
    {
        if(!$request->isXmlHttpRequest()){
            throw $this->createNotFoundException();
        }
    }

}
