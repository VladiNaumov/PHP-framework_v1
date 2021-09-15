<?php

namespace vendor\core\base;

 abstract class Controller
{

    //текущий маршрут
    public array $route = [];

    //текущий вид
    public  $view;

    //текущий шаблон
    public  $layout;

    public array $vars = [];

    /**
     * @param array $route
     */
    public function __construct(array $route)
    {
        $this -> route = $route;
        $this -> view = $route['action'];

    }

    public function getView(){
        $vObj = new View($this->route, $this->layout, $this->view);
        $vObj ->render($this->vars);
    }

    public function set($vars){
        $this->vars = $vars;
    }

    public static function demo() {}

}