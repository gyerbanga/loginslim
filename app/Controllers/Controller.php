<?php
namespace App\Controllers;


class Controller{
    protected $container;
    public function __construct($container)
    {
        $this->container=$container;
    }


    public function __get($property)
    {
        /**
         * permet d'utiliser directement view-> à la place de container->view
         */
        if ($this->container->{$property}){
            return $this->container->{$property};
        }
    }
}