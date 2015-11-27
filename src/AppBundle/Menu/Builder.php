<?php

namespace AppBundle\Menu;
 
use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
 
class Builder extends ContainerAware
{
    public function navMenu(FactoryInterface $factory, array $options) 
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        $menu->addChild('test', [
            'route' => 'test',
            'label' => '考试列表'
        ]);
        return $menu;
    }
}
?>


