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
     * @param string $env Current environment
     * @return boolean is on or off
     */
    public static function checkAC(AireAcondicionado $ac, $env){
        //si esta en produccion se mandara la peticion al arduino
        if($env === 'prod') {
            $handler = curl_init("http://".$ac->getArduino()->getIp()."/pass=do/check/LED".$ac->getPin());
            curl_setopt($handler, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($handler, CURLOPT_VERBOSE, 0);
            curl_setopt($handler, CURLOPT_HEADER, 1);

            $response = curl_exec ($handler);
            $header_size = curl_getinfo($handler, CURLINFO_HEADER_SIZE);
    //        $header = substr($response, 0, $header_size);
            $body = substr($response, $header_size);
            $body_size=strlen($body)-2;
            $body_clean=substr($body,0,$body_size);
            curl_close($handler);
            if($body_clean==="true"){
                return 1;
            }
            else {
                return 0;
            }
        }
        //en caso diferente se regresara un valor aleatorio
        else {
            return (rand(0,1)==1);
        }
    }
    /**
     * turns on the AC
     * 
     * @param \ItesAC\BackendBundle\Entity\AireAcondicionado $ac
     * @param string $env Current environment
     */
    public static function turnOnAC(AireAcondicionado $ac, $env){
        //si esta en produccion se mandara la peticion al arduino
        if($env === 'prod') {
            $handler = curl_init("http://".$ac->getArduino()->getIp()."/pass=do/turnon/LED".$ac->getPin());
            curl_setopt($handler, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($handler, CURLOPT_VERBOSE, 0);
            curl_setopt($handler, CURLOPT_HEADER, 1);

            $response = curl_exec ($handler);
            $header_size = curl_getinfo($handler, CURLINFO_HEADER_SIZE);
    //        $header = substr($response, 0, $header_size);
            $body = substr($response, $header_size);
            $body_size=strlen($body)-2;
            $body_clean=substr($body,0,$body_size);
            curl_close($handler);
            return $body_clean;
        }
    }
    /**
     * turns off the AC
     * 
     * @param \ItesAC\BackendBundle\Entity\AireAcondicionado $ac
     * @param string $env Current environment
     */
    public static function turnOffAC(AireAcondicionado $ac, $env){
        //si esta en produccion se mandara la peticion al arduino
        if($env === 'prod') {
            $handler = curl_init("http://".$ac->getArduino()->getIp()."/pass=do/turnoff/LED".$ac->getPin());
            curl_setopt($handler, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($handler, CURLOPT_VERBOSE, 0);
            curl_setopt($handler, CURLOPT_HEADER, 1);

            $response = curl_exec ($handler);
            $header_size = curl_getinfo($handler, CURLINFO_HEADER_SIZE);
    //        $header = substr($response, 0, $header_size);
            $body = substr($response, $header_size);
            $body_size=strlen($body)-2;
            $body_clean=substr($body,0,$body_size);
            curl_close($handler);
            return $body_clean;
        }
    }
}