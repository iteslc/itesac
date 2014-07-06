<?php

namespace ItesAC\BackendBundle\Menu;

use Knp\Menu\FactoryInterface;

/**
 * Description of Builder
 *
 * @author Dany Cast
 */
class Builder {

    public function menuAction(FactoryInterface $factory, array $options) {
        $menu = $factory->createItem('root');
        
        $menu->addChild('Aire Acondicionado', array('route' => 'ac'));
        $menu->addChild('Planta', array('route' => 'planta'));
        $menu->addChild('Edificio', array('route' => 'edificio'));
        $menu->addChild('Arduino', array('route' => 'arduino'));
        $menu->addChild('Modelo', array('route' => 'modelo'));
        

        return $menu;
    }

}