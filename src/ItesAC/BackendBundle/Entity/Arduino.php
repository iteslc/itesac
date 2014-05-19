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
}
