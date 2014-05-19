<?php

namespace ItesAC\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AireAcondicionadoType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pin')
            ->add('posicionX','hidden',array(
                'data' => 0
            ))
            ->add('posicionY','hidden',array(
                'data' => 0
            ))
            ->add('modelo','entity', array(
                'class' => 'ItesACBackendBundle:Modelo',
                'property' => 'nombre',
            ))
            ->add('arduino','entity', array(
                'class' => 'ItesACBackendBundle:Arduino',
                'property' => 'ip',
            ))
            ->add('planta','entity', array(
                'class' => 'ItesACBackendBundle:Planta',
                'property' => 'alias',
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ItesAC\BackendBundle\Entity\AireAcondicionado'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'itesac_backendbundle_aireacondicionado';
    }
}
