<?php

namespace ItesAC\ControlBundle\Manager;

use ItesAC\BackendBundle\Entity\AireAcondicionado;

/**
 * Manager to control AC operations
 *
 * @author Dany Cast
 */
class ACManager {
    
    /**
     * Check AC's current status
     * 
     * @param \ItesAC\BackendBundle\Entity\AireAcondicionado $ac
     * @return boolean is on or off
     */
    public static function checkAC(AireAcondicionado $ac){
        //se mandara la peticion al arduino
        //return (rand(0,1)==1);
        $handler = curl_init("http://".$ac->getArduino()->getIp()."/pass=do/check/LED".$ac->getPin());
        curl_setopt($handler, CURLOPT_TIMEOUT, 50000);
        curl_setopt($handler, CURLOPT_HEADER, 0);
        curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec ($handler);
        curl_close($handler);
        return "http://".$ac->getArduino()->getIp()."/pass=do/check/LED".$ac->getPin();
    }
    /**
     * turns on the AC
     * 
     * @param \ItesAC\BackendBundle\Entity\AireAcondicionado $ac
     */
    public static function turnOnAC(AireAcondicionado $ac){
        //se mandara la instruccion al arduino
        //$handler = curl_init("http://".$ac->getArduino()->getIp()."/pass=do/turnon/LED".$ac->getPin());
        $handler = curl_init("http://www.google.com");
        curl_setopt($handler, CURLOPT_TIMEOUT, 50000);
        curl_setopt($handler, CURLOPT_HEADER, 0);
        curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec ($handler);
        $error=curl_error($handler).curl_errno($handler);
        curl_close($handler);
        return $response;
        
    }
    /**
     * turns off the AC
     * 
     * @param \ItesAC\BackendBundle\Entity\AireAcondicionado $ac
     */
    public static function turnOffAC(AireAcondicionado $ac){
        //se mandara la peticion al arduino
        $handler = curl_init("http://".$ac->getArduino()->getIp()."/pass=do/turnoff/LED".$ac->getPin());
        curl_setopt($handler, CURLOPT_TIMEOUT, 50000);
        curl_setopt($handler, CURLOPT_HEADER, 0);
        curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec ($handler);
        curl_close($handler);
        return $response;
    }
}