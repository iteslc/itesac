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
use Symfony\Component\HttpFoundation\JsonResponse;

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
        
        $info=array();
        //checara cada uno su estado
        foreach ($aires as $ac) {
            if(!ACManager::checkAC($ac)){
                $info[]=array(  'id'        =>$ac->getId(),
                                'planta'    =>$ac->getPlanta()->getId(),
                                'edificio'  =>$ac->getEdificio()->getId());
            }
        }
        return new JsonResponse($info);
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
        //obtendra todos los ac
        $em = $this->getDoctrine()->getManager();
        $aires = $em->getRepository('ItesACBackendBundle:AireAcondicionado')->findAll();
        //apaga cada uno
        foreach ($aires as $ac) {
            ACManager::turnOffAC($ac);
        }
        return new Response();
    }
    /**
     * Checks status of all ac in the institution
     * 
     * @Route("/all/check", name="control_all_check")
     * @Method("GET")
     * @Template()
     */
    public function checkAllAction(Request $request)
    {
        if(!$request->isXmlHttpRequest()){
            throw $this->createNotFoundException();
        }
        //obtendra todos los ac
        $em = $this->getDoctrine()->getManager();
        $aires = $em->getRepository('ItesACBackendBundle:AireAcondicionado')->findAll();
        
        $info=array();
        //checara cada uno su estado
        foreach ($aires as $ac) {
            $info[]=array(  'id'        => $ac->getId(),
                            'planta'    => $ac->getPlanta()->getId(),
                            'edificio'  => $ac->getEdificio()->getId(),
                            'isOn'      => ACManager::checkAC($ac));
        }
        return new JsonResponse($info);
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
        $info=array();
        //checara cada uno su estado
        foreach ($edificio->getAires() as $ac) {
            if(!ACManager::checkAC($ac)){
                $info[]=array(  'id'        =>$ac->getId(),
                                'planta'    =>$ac->getPlanta()->getId(),
                                'edificio'  =>$ac->getEdificio()->getId());
            }
        }
        return new JsonResponse($info);
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
        //apaga cada uno
        foreach ($edificio->getAires() as $ac) {
            ACManager::turnOffAC($ac);
        }
        return new Response();
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
        $info=array();
        //checara cada uno su estado
        foreach ($planta->getAires() as $ac) {
            if(!ACManager::checkAC($ac)){
                $info[]=array(  'id'        =>$ac->getId(),
                                'planta'    =>$ac->getPlanta()->getId(),
                                'edificio'  =>$ac->getEdificio()->getId());
            }
        }
        return new JsonResponse($info);
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
        //apaga cada uno
        foreach ($planta->getAires() as $ac) {
            ACManager::turnOffAC($ac);
        }
        return new Response();
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
        $info=array();
        //checara cada uno su estado
        foreach ($planta->getAires() as $ac) {
            $info[]=array(  'id'        => $ac->getId(),
                            'planta'    => $ac->getPlanta()->getId(),
                            'edificio'  => $ac->getEdificio()->getId(),
                            'isOn'      => ACManager::checkAC($ac));
        }
        return new JsonResponse($info);
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
        //checa si esta habilitado para encender aires
        if(isTurnOnEnable()){
            ACManager::turnOnAC($ac);
        }
        return new Response();
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
        ACManager::turnOffAC($ac);
        
        return new Reponse();
    }
    /**
     * is enable if all ac's last on is since more than 15 seconds
     * 
     * @return boolean
     */
    private function isTurnOnEnable(){
        return true;
    }
}
