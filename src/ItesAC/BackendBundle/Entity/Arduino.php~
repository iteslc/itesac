<?php

namespace ItesAC\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Arduino
 *
 * @ORM\Table()
 * @ORM\Entity
 * @UniqueEntity(fields="ip", message="Ya existe un arduino con esa ip")
 */
class Arduino
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
     * @var string
     *
     * @Assert\Ip(
     *      message="Escriba una Ip valida"
     * )
     * @ORM\Column(name="ip", type="string", length=20)
     */
    private $ip;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AireAcondicionado", mappedBy="arduino")
     */
    private $aires;

    /**
     * @var ItesAC\BackendBundle\Entity\Edificio
     *
     * @ORM\ManyToOne(targetEntity="Edificio", inversedBy="arduinos")
     * @ORM\JoinColumn(name="edificio_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $edificio;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->aires = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set ip
     *
     * @param  string  $ip
     * @return Arduino
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Add aires
     *
     * @param  \ItesAC\BackendBundle\Entity\AireAcondicionado $aires
     * @return Arduino
     */
    public function addAire(\ItesAC\BackendBundle\Entity\AireAcondicionado $aires)
    {
        if ($this->aires->isEmpty()) {
            $this->setEdificio($aires->getEdificio());
        }
        $this->aires[] = $aires;

        return $this;
    }

    /**
     * Remove aires
     *
     * @param \ItesAC\BackendBundle\Entity\AireAcondicionado $aires
     */
    public function removeAire(\ItesAC\BackendBundle\Entity\AireAcondicionado $aires)
    {
        $this->aires->removeElement($aires);
        if ($this->aires->isEmpty()) {
            $this->setEdificio(null);
        }
    }

    /**
     * Get aires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAires()
    {
        return $this->aires;
    }

    /**
     * Obtiene pines disponibles del arduino
     *
     * @return array
     * @param  \ItesAC\BackendBundle\Entity\AireAcondicionado $aire
     */
    public function getPinesDisponibles(\ItesAC\BackendBundle\Entity\AireAcondicionado $aire)
    {
        $disponibles = array();
        for ($i=2;$i<=13;$i++) {
            $disponibles[$i]=$i;
        }
        foreach ($this->getAires() as $air) {
            $isEqual = $air->getPin() === $aire->getPin();
            $index = array_search($air->getPin(), $disponibles);
            if ($index!==null&&!$isEqual) {
                unset($disponibles[$index]);
            }
        }

        return $disponibles;
    }

    /**
     * Set edificio
     *
     * @param  \ItesAC\BackendBundle\Entity\Edificio $edificio
     * @return Arduino
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
}
