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

//        $menu->addChild('Control', array('route' => ''));
        //se agregara uno a control y los demas de cada elemento del backend
        

        return $menu;
    }

}