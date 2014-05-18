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
     * @var AireAC\BackendBundle\Entity\Modelo
     *
     * @ORM\ManyToOne(targetEntity="Modelo")
     * @ORM\JoinColumn(name="modelo_id", referencedColumnName="id")
     */
    private $modelo;

    /**
     * @var AireAC\BackendBundle\Entity\Arduino
     *
     * @ORM\ManyToOne(targetEntity="Arduino")
     * @ORM\JoinColumn(name="arduino_id", referencedColumnName="id")
     */
    private $arduino;

    /**
     * @var AireAC\BackendBundle\Entity\Planta
     *
     * @ORM\ManyToOne(targetEntity="Planta", inversedBy="aires")
     * @ORM\JoinColumn(name="planta_id", referencedColumnName="id")
     */
    private $planta;

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
     * @param  integer           $pin
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
     * @param  float             $posicionX
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
     * @param  float             $posicionY
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

    /**
     * Set modelo
     *
     * @param  \ItesAC\BackendBundle\Entity\Modelo $modelo
     * @return AireAcondicionado
     */
    public function setModelo(\ItesAC\BackendBundle\Entity\Modelo $modelo = null)
    {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * Get modelo
     *
     * @return \ItesAC\BackendBundle\Entity\Modelo
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set arduino
     *
     * @param  \ItesAC\BackendBundle\Entity\Arduino $arduino
     * @return AireAcondicionado
     */
    public function setArduino(\ItesAC\BackendBundle\Entity\Arduino $arduino = null)
    {
        $this->arduino = $arduino;

        return $this;
    }

    /**
     * Get arduino
     *
     * @return \ItesAC\BackendBundle\Entity\Arduino
     */
    public function getArduino()
    {
        return $this->arduino;
    }

    /**
     * Set planta
     *
     * @param  \ItesAC\BackendBundle\Entity\Planta $planta
     * @return AireAcondicionado
     */
    public function setPlanta(\ItesAC\BackendBundle\Entity\Planta $planta = null)
    {
        $this->planta = $planta;

        return $this;
    }

    /**
     * Get planta
     *
     * @return \ItesAC\BackendBundle\Entity\Planta
     */
    public function getPlanta()
    {
        return $this->planta;
    }
}
