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
use Symfony\Component\HttpFoundation\Response;

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
        $turner=$this->getLatelyACTurnedOn();
        if($turner){
            $info=$this->getInfoOfLastAC($turner);
            return new JsonResponse($info);
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
        $turner=$this->getLatelyACTurnedOn();
        if($turner){
            $info=$this->getInfoOfLastAC($turner);
            return new JsonResponse($info);
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
        $turner=$this->getLatelyACTurnedOn();
        if($turner){
            $info=$this->getInfoOfLastAC($turner);
            return new JsonResponse($info);
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
     * @Route("/ac/{id}/on/{tail}", name="control_ac_on", defaults={"tail" = 0})
     * @ParamConverter("ac", class="ItesACBackendBundle:AireAcondicionado")
     * @Method("GET")
     */
    public function turnOnACAction(Request $request, AireAcondicionado $ac,$tail)
    {
        if(!$request->isXmlHttpRequest()){
            throw $this->createNotFoundException();
        }
        
        $turner=$this->getLatelyACTurnedOn();
        if($turner){
            $info=$this->getInfoOfLastAC($turner);
            return new JsonResponse($info);
        }
        
        $em=$this->getDoctrine()->getEntityManager();
        ACManager::turnOnAC($ac);
        $ac->setLastOn();
        $ac->setTail($tail);
        $em->persist($ac);
        $em->flush();
        return new JsonResponse();
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
        
        return new Response();
    }
    /**
     * Checks the current process status
     * 
     * @Route("/checkprocess", name="control_check_process")
     * @Method("GET")
     */
    public function checkProcessAction(Request $request)
    {
        if(!$request->isXmlHttpRequest()){
            throw $this->createNotFoundException();
        }
        
        $turner=$this->getLatelyACTurnedOn();
        if($turner){
            $info=$this->getInfoOfLastAC($turner);
            return new JsonResponse($info);
        }
        
        return new JsonResponse();
    }
    /**
     * get the ac turned on 30 seconds ago
     * 
     * @return \ItesAC\BackendBundle\Entity\AireAcondicionado
     */
    private function getLatelyACTurnedOn(){
        $now=new \DateTime("now");
        $time=$now->sub(new \DateInterval('PT30S'));
        
        $repository = $this ->getDoctrine()
                            ->getRepository('ItesACBackendBundle:AireAcondicionado');
        
        $query = $repository->createQueryBuilder('a')
                            ->where('a.lastOn >= :ago')
                            ->setParameter('ago', $time)
                            ->getQuery();

        return $query->getOneOrNullResult();
    }
    /**
     * get array with info about the last ac turned on
     * 
     * @param \ItesAC\BackendBundle\Entity\AireAcondicionado $turner
     * @return array
     */
    private function getInfoOfLastAC(AireAcondicionado $turner){
        $interval=$turner->getLastOn()->diff(new \DateTime("now"));
        $info=array('id'        => $turner->getId(),
                    'planta'    => $turner->getPlanta()->getId(),
                    'edificio'  => $turner->getEdificio()->getId(),
                    'lastOn'    => $interval->format('%s'),
                    'tail'      => $turner->getTail());
        return $info;
    }
}
