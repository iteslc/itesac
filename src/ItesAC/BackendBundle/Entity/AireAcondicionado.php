<?php

namespace ItesAC\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotNull(
     *      message="Este campo es requerido."
     * )
     * @Assert\Range(
     *      min="2",
     *      max="13",
     *      minMessage="El pin debe ser del 2 al 13",
     *      maxMessage="El pin debe ser del 2 al 13"
     * )
     * @ORM\Column(name="pin", type="smallint")
     */
    private $pin;

    /**
     * @var integer
     *
     * @Assert\NotNull(
     *      message="Coloque una posicion."
     * )
     * @Assert\Range(
     *      min="0",
     *      max="96",
     *      minMessage="Coloque una posicion valida",
     *      maxMessage="Coloque una posicion valida"
     * )
     * @ORM\Column(name="posicionX", type="integer")
     */
    private $posicionX;

    /**
     * @var integer
     *
     * @Assert\NotNull(
     *      message="Coloque una posicion."
     * )
     * @Assert\Range(
     *      min="0",
     *      max="96",
     *      minMessage="Coloque una posicion valida",
     *      maxMessage="Coloque una posicion valida"
     * )
     * @ORM\Column(name="posicionY", type="integer")
     */
    private $posicionY;

    /**
     * @var AireAC\BackendBundle\Entity\Modelo
     *
     * @Assert\NotNull(
     *      message="Seleccione un modelo"
     * )
     * @ORM\ManyToOne(targetEntity="Modelo")
     * @ORM\JoinColumn(name="modelo_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $modelo;

    /**
     * @var AireAC\BackendBundle\Entity\Arduino
     *
     * @Assert\NotNull(
     *      message="Seleccione un arduino"
     * )
     * @ORM\ManyToOne(targetEntity="Arduino", inversedBy="aires")
     * @ORM\JoinColumn(name="arduino_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $arduino;

    /**
     * @var AireAC\BackendBundle\Entity\Planta
     *
     * @Assert\NotNull(
     *      message="Seleccione una planta"
     * )
     * @ORM\ManyToOne(targetEntity="Planta", inversedBy="aires")
     * @ORM\JoinColumn(name="planta_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $planta;

    /**
     * @var AireAC\BackendBundle\Entity\Edificio
     *
     * @Assert\NotNull(
     *      message="Seleccione un edificio"
     * )
     * @ORM\ManyToOne(targetEntity="Edificio", inversedBy="aires")
     * @ORM\JoinColumn(name="edificio_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $edificio;

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
     * @param  integer           $posicionX
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
     * @return integer
     */
    public function getPosicionX()
    {
        return $this->posicionX;
    }

    /**
     * Set posicionY
     *
     * @param  integer           $posicionY
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
     * @return integer
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
        if($arduino){
            $arduino->addAire($this);
        }
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

    /**
     * Set edificio
     *
     * @param  \ItesAC\BackendBundle\Entity\Edificio $edificio
     * @return AireAcondicionado
     */
    public function setEdificio(\ItesAC\BackendBundle\Entity\Edificio $edificio = null)
    {
        $this->edificio = $edificio;

        return $this;
    }

    /**
     * Get edificio
     *
     * @return \ItesAC\BackendBundle\Entity\Edificio
     */
    public function getEdificio()
    {
        return $this->edificio;
    }

    /**
     * is Congruente el edificio con el arduino
     *
     * @return boolean
     *
     * @Assert\True(
     *  message="El arduino no es valido para ese edificio"
     * )
     */
    public function isEdificioYArduinoCongruente()
    {
        if($this->arduino===null){
            return true;
        }
        if ($this->edificio===$this->arduino->getEdificio()||
                $this->arduino->getEdificio()===null) {
            return true;
        } else {
            return false;
        }
    }
}
