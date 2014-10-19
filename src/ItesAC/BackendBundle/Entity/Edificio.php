<?php

namespace ItesAC\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Edificio
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ItesAC\BackendBundle\Entity\EdificioRepository")
 * @UniqueEntity(fields="nombre", message="Ya existe ese edificio")
 */
class Edificio
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
     * @Assert\NotNull(
     *      message="Escriba un nombre para el edificio"
     * )
     * @Assert\Length(
     *      min=1,
     *      minMessage="Escriba un nombre para el edificio"
     * )
     * @ORM\Column(name="nombre", type="string", length=5)
     */
    private $nombre;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Planta", mappedBy="edificio")
     */
    private $plantas;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AireAcondicionado", mappedBy="edificio")
     */
    private $aires;
    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Arduino", mappedBy="edificio")
     */
    private $arduinos;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->plantas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param  string   $nombre
     * @return Edificio
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
     * Add plantas
     *
     * @param  \ItesAC\BackendBundle\Entity\Planta $plantas
     * @return Edificio
     */
    public function addPlanta(\ItesAC\BackendBundle\Entity\Planta $plantas)
    {
        $this->plantas[] = $plantas;

        return $this;
    }

    /**
     * Remove plantas
     *
     * @param \ItesAC\BackendBundle\Entity\Planta $plantas
     */
    public function removePlanta(\ItesAC\BackendBundle\Entity\Planta $plantas)
    {
        $this->plantas->removeElement($plantas);
    }

    /**
     * Get plantas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlantas()
    {
        return $this->plantas;
    }

    /**
     * Get plantas disponibles
     *
     * @param  \ItesAC\BackendBundle\Entity\Planta $planta
     * @return array
     */
    public function getPlantasDisponibles(\ItesAC\BackendBundle\Entity\Planta $planta = null)
    {
        $disponibles = array('PB'=>'PB','P1'=>'P1');
        foreach ($this->getPlantas() as $plant) {
            $isEqual = $plant->getNombre() === $planta->getNombre();
            $index = array_search($plant->getNombre(), $disponibles);
            if ($index!==null&&!$isEqual) {
                unset($disponibles[$index]);
            }
        }

        return $disponibles;
    }

    /**
     * Add aires
     *
     * @param  \ItesAC\BackendBundle\Entity\AireAcondicionado $aires
     * @return Edificio
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

    /**
     * Add arduinos
     *
     * @param \ItesAC\BackendBundle\Entity\Arduino $arduinos
     * @return Edificio
     */
    public function addArduino(\ItesAC\BackendBundle\Entity\Arduino $arduinos)
    {
        $this->arduinos[] = $arduinos;

        return $this;
    }

    /**
     * Remove arduinos
     *
     * @param \ItesAC\BackendBundle\Entity\Arduino $arduinos
     */
    public function removeArduino(\ItesAC\BackendBundle\Entity\Arduino $arduinos)
    {
        $this->arduinos->removeElement($arduinos);
    }

    /**
     * Get arduinos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArduinos()
    {
        return $this->arduinos;
    }
}
