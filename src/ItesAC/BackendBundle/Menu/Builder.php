<?php

namespace ItesAC\BackendBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * Menu builder
 *
 * @author Dany Cast
 */
class Builder extends ContainerAware{

    /**
     * Creates a menu for the backend
     * 
     * @param \Knp\Menu\FactoryInterface $factory
     * @param array $options
     * @return \Knp\Menu
     */
    public function backendMenu(FactoryInterface $factory, array $options) {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav nav-pills nav-stacked');

        $menu->addChild('AC', array('route' => 'ac'));
        $menu->addChild('Planta', array('route' => 'planta'));
        $menu->addChild('Edificio', array('route' => 'edificio'));
        $menu->addChild('Arduino', array('route' => 'arduino'));
        $menu->addChild('Modelo', array('route' => 'modelo'));
        

        return $menu;
    }

}