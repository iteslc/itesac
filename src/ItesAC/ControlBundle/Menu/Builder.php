<?php

namespace ItesAC\ControlBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * Menu builder
 *
 * @author Dany Cast
 */
class Builder extends ContainerAware{

    /**
     * Creates a menu for the institution control
     * 
     * @param \Knp\Menu\FactoryInterface $factory
     * @param array $options
     * @return \Knp\Menu
     */
    public function controlInstitutionMenu(FactoryInterface $factory, array $options) {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav nav-pills nav-justified');

        $menu->addChild('Backend',array('route'=>'ac'));
        $menu->addChild('Enciende todo', array('route' => 'control_all_on'));
        $menu->addChild('Apaga todo', array('route' => 'control_all_off'));
        
        return $menu;
    }
    /**
     * Creates a menu for the planta control
     * 
     * @param \Knp\Menu\FactoryInterface $factory
     * @param array $options
     * @return \Knp\Menu
     */
    public function controlPlantaMenu(FactoryInterface $factory, array $options) {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav nav-pills nav-justified');

        $menu->addChild('Backend',array('route'=>'ac'));
        $menu->addChild('Edificios',array('route'=>'institution'));
        $menu->addChild('Enciende planta', array('route' => 'control_planta_on'));
        $menu->addChild('Apaga planta', array('route' => 'control_planta_off'));
        
        return $menu;
    }

}