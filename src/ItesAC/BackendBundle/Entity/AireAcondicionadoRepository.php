<?php

namespace ItesAC\BackendBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * AireAcondicionadoRepository
 *
 */
class AireAcondicionadoRepository extends EntityRepository
{
    public function findAllWithJoins(){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT ac, ar, e, p, m FROM ItesACBackendBundle:AireAcondicionado ac
                JOIN ac.arduino ar
                JOIN ac.edificio e
                JOIN ac.planta p
                JOIN ac.modelo m'
            )
            ->getResult();
    }
    public function findAllWithArduino(){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT ac, ar FROM ItesACBackendBundle:AireAcondicionado ac
                JOIN ac.arduino ar'
            )
            ->getResult();
    }
    public function findByIdWithJoins($id){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT ac, ar, e, p, m FROM ItesACBackendBundle:AireAcondicionado ac
                JOIN ac.arduino ar
                JOIN ac.edificio e
                JOIN ac.planta p
                JOIN ac.modelo m
                WHERE ac.id = :id'
            )
            ->setParameter("id", $id)
            ->getOneOrNullResult();
    }
    public function findByIdWithPlanta($id){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT ac, p FROM ItesACBackendBundle:AireAcondicionado ac
                JOIN ac.planta p
                WHERE ac.id = :id'
            )
            ->setParameter("id", $id)
            ->getOneOrNullResult();
    }
    public function findByIdWithArduino($id){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT ac, ar FROM ItesACBackendBundle:AireAcondicionado ac
                JOIN ac.arduino ar
                WHERE ac.id = :id'
            )
            ->setParameter("id", $id)
            ->getOneOrNullResult();
    }
}
