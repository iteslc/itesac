<?php

namespace ItesAC\BackendBundle\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Planta
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ItesAC\BackendBundle\Entity\PlantaRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields="alias", message="Ya existe esa planta")
 * @Vich\Uploadable
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
     * @Assert\NotNull(message="Seleccione el piso")
     * @Assert\Choice(
     *      choices={"PB","P1"},
     *      message="Seleccione el piso"
     * )
     * @ORM\Column(name="nombre", type="string", length=5)
     */
    private $nombre;

    /**
     * @var ItesAC\BackendBundle\Entity\Edificio
     *
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="Edificio", inversedBy="plantas")
     * @ORM\JoinColumn(name="edificio_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $edificio;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AireAcondicionado", mappedBy="planta")
     */
    private $aires;

    /**
     * @var File
     *
     * @Assert\NotNull(
     *      message="Un mapa de la planta es requerida"
     * )
     * @Assert\Image(
     *     maxSize="1M",
     *     mimeTypes={"image/png"},
     *     maxSizeMessage="El limite de carga es de 1M",
     *     mimeTypesMessage="Debe ser una imagen png"
     * )
     * @Vich\UploadableField(mapping="plantas_image", fileNameProperty="imageName")
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, name="image_name")
     */
    private $imageName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, name="alias")
     */
    private $alias;

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

    /**
     * Set imageName
     *
     * @param  string $imageName
     * @return Planta
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get imageName
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImage(File $image)
    {
        $this->image = $image;
    }

    /**
     * @return File
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set alias
     *
     * @return Planta
     *
     */
    public function setAlias()
    {
        $this->alias = "Edificio " . $this->getEdificio()->getNombre() . " " . $this->nombre;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @ORM\PrePersist
     */
    public function postPersist()
    {
        $this->setAlias();
    }

    /**
     * @ORM\PreUpdate
     */
    public function postUpdate()
    {
        $this->setAlias();
    }
}
