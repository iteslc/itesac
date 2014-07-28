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
        return (rand(0,1)==1);
//        return false;
    }
    /**
     * turns on the AC
     * 
     * @param \ItesAC\BackendBundle\Entity\AireAcondicionado $ac
     */
    public static function turnOnAC(AireAcondicionado $ac){
        //se mandara la instruccion al arduino
    }
    /**
     * turns off the AC
     * 
     * @param \ItesAC\BackendBundle\Entity\AireAcondicionado $ac
     */
    public static function turnOffAC(AireAcondicionado $ac){
        //se mandara la peticion al arduino
    }
}