<?php

namespace ItesAC\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ItesAC\BackendBundle\Entity\Edificio;
use ItesAC\BackendBundle\Entity\Planta;

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
            'empty_value' => 'Escoge un edificio',
            ))
            ->add('image');
        
        $formModifier = function (FormInterface $form, Edificio $edificio = null, Planta $planta) {
            $plantas = null === $edificio ? array() : $edificio->getPlantasDisponibles($planta);

            $form->add('nombre', 'choice', array(
                'empty_value' => 'Seleccione una planta',
                'choices'     => $plantas,
            ));
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();

                $formModifier($event->getForm(), $data->getEdificio(), $data);
            }
        );

        $builder->get('edificio')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $edificio = $event->getForm()->getData();

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
                $formModifier($event->getForm()->getParent(), $edificio, $event->getForm()->getParent()->getData());
            }
        );
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
        return 'planta';
    }
}
