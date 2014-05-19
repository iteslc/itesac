<?php

namespace ItesAC\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlantaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('edificio','entity', array(
            'class' => 'ItesACBackendBundle:Edificio',
            'property' => 'nombre',
        ));
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                $form = $event->getForm();
                $data = $event->getData();
                
                $edificio = $data->getEdificio();

                $plantas = null === $edificio ? array() : $edificio->getPlantasDisponibles($data);

                $form->add('nombre', 'choice', array(
                    'choices'     => $plantas,
                ));
            }
        );
        $builder->add('image');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ItesAC\BackendBundle\Entity\Planta'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'itesac_backendbundle_planta';
    }
}
