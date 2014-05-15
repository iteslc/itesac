<?php

namespace ItesAC\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AireAcondicionado
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class AireAcondicionado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="pin", type="smallint")
     */
    private $pin;

    /**
     * @var float
     *
     * @ORM\Column(name="posicionX", type="float")
     */
    private $posicionX;

    /**
     * @var float
     *
     * @ORM\Column(name="posicionY", type="float")
     */
    private $posicionY;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pin
     *
     * @param integer $pin
     * @return AireAcondicionado
     */
    public function setPin($pin)
    {
        $this->pin = $pin;

        return $this;
    }

    /**
     * Get pin
     *
     * @return integer 
     */
    public function getPin()
    {
        return $this->pin;
    }

    /**
     * Set posicionX
     *
     * @param float $posicionX
     * @return AireAcondicionado
     */
    public function setPosicionX($posicionX)
    {
        $this->posicionX = $posicionX;

        return $this;
    }

    /**
     * Get posicionX
     *
     * @return float 
     */
    public function getPosicionX()
    {
        return $this->posicionX;
    }

    /**
     * Set posicionY
     *
     * @param float $posicionY
     * @return AireAcondicionado
     */
    public function setPosicionY($posicionY)
    {
        $this->posicionY = $posicionY;

        return $this;
    }

    /**
     * Get posicionY
     *
     * @return float 
     */
    public function getPosicionY()
    {
        return $this->posicionY;
    }
}
