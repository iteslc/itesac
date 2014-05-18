<?php

namespace ItesAC\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Planta
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Planta
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
     * @ORM\Column(name="nombre", type="string", length=5)
     */
    private $nombre;

    /**
     * @var ItesAC\BackendBundle\Entity\Edificio
     *
     * @ORM\ManyToOne(targetEntity="Edificio", inversedBy="plantas")
     * @ORM\JoinColumn(name="edificio_id", referencedColumnName="id")
     */
    private $edificio;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AireAcondicionado", mappedBy="planta")
     */
    private $aires;

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
     * Set nombre
     *
     * @param  string $nombre
     * @return Planta
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set edificio
     *
     * @param  \ItesAC\BackendBundle\Entity\Edificio $edificio
     * @return Planta
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
     * Add aires
     *
     * @param  \ItesAC\BackendBundle\Entity\AireAcondicionado $aires
     * @return Planta
     */
    public function addAire(\ItesAC\BackendBundle\Entity\AireAcondicionado $aires)
    {
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
}
