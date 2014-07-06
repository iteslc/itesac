<?php

namespace ItesAC\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ItesAC\BackendBundle\Entity\Arduino;
use ItesAC\BackendBundle\Entity\AireAcondicionado;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use ItesAC\BackendBundle\Entity\Edificio;

class AireAcondicionadoType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('posicionX','hidden',array(
                'data' => 0
            ))
            ->add('posicionY','hidden',array(
                'data' => 0
            ))
            ->add('modelo','entity', array(
                'class' => 'ItesACBackendBundle:Modelo',
                'property' => 'nombre',
                'empty_value' => 'Seleccione un modelo',
            ))
            ->add('edificio','entity', array(
                'class' => 'ItesACBackendBundle:Edificio',
                'property' => 'nombre',
                'empty_value' => 'Seleccione un edificio',
                'attr' => array('class' => 'changer', 'data-target' => '#aireacondicionado_planta'),
            ))
            ->add('arduino','entity', array(
                'class' => 'ItesACBackendBundle:Arduino',
                'property' => 'ip',
                'empty_value' => 'Seleccione la ip del arduino',
                'by_reference' => true,
                'attr' => array('class' => 'changer', 'data-target' => '#aireacondicionado_pin'),
            ))
        ;
        $formModifierByEdificio = function (FormInterface $form, Edificio $edificio = null) {
            $plantas = null === $edificio ? array() : $edificio->getPlantas();

            $form->add('planta', 'entity', array(
                'class' => 'ItesACBackendBundle:Planta',
                'empty_value' => 'Seleccione una planta',
                'choices'     => $plantas,
                'property' => 'nombre',
            ));
        };
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifierByEdificio) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();

                $formModifierByEdificio($event->getForm(), $data->getEdificio());
            }
        );

        $builder->get('edificio')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifierByEdificio) {
                $edificio = $event->getForm()->getData();
                $formModifierByEdificio($event->getForm()->getParent(), $edificio);
            }
        );

        $formModifierByArduino = function (FormInterface $form, Arduino $arduino = null, AireAcondicionado $aire) {
            $pines = null === $arduino ? array() : $arduino->getPinesDisponibles($aire);

            $form->add('pin', 'choice', array(
                'empty_value' => 'Seleccione un pin del arduino',
                'choices'     => $pines,
            ));
        };
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifierByArduino) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();

                $formModifierByArduino($event->getForm(), $data->getArduino(), $data);
            }
        );

        $builder->get('arduino')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifierByArduino) {
                $arduino = $event->getForm()->getData();
                $formModifierByArduino($event->getForm()->getParent(), $arduino, $event->getForm()->getParent()->getData());
            }
        );
        if($options['ajax']){
            $builder->addEventListener(FormEvents::POST_SUBMIT, function ($event) {
                $event->stopPropagation();
            }, 900);
        }
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ItesAC\BackendBundle\Entity\AireAcondicionado',
            'ajax' => false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'aireacondicionado';
    }
}
