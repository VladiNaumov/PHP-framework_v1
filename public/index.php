<?php

//S5 08:21

error_reporting(-1);

use vendor\core\Ruoter;

//считывания данных с URL браузера
 $query = rtrim($_SERVER['QUERY_STRING'], '/');

    const WWWW = __DIR__;
    const LAYOUT = 'default';

    define('ROOT', dirname( __DIR__));
    define('APP', dirname( __DIR__) . '/app');

 //   define('CORE', dirname( __DIR__) . '/vendor/core');


     require '../vendor/libs/functions.php';


    spl_autoload_register(function ($class){

        $file = ROOT . '/' . str_ireplace('\\', '/', $class) . '.php';
          if (is_file($file)){
            require_once $file;
        }
    });
	

    //https://naumdeveloper.site/page/view/about получаем:  [controller] => PageController  [action] => view  [alias] => about
    Ruoter::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$',['controller' => 'PageController']);

    //https://naumdeveloper.site/page/about получаем:  [controller] => PageController  [action] => view  [alias] => about
    Ruoter::add('^page/(?P<alias>[a-z-]+)$',['controller' => 'PageController', 'action' => 'view']);

    //https://naumdeveloper.site получаем: [controller] => PageController  [action] =>index
     Ruoter::add('^$',['controller' => 'Main','action'=>'index']);

    //https://naumdeveloper.site/page получаем:  [controller] => PageController  [action] =>index
    Ruoter::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');


    Ruoter::dispatch($query);

   /*
    * Дваеточие - это обращение к статическому методу
    * Ruoter::dispatch($query);
    *
    * $DEMO = new DemoDemo();
    * $DEMO->myDemo();
    * $DEMO->myDemo();
    * $DEMO::myStaticDemo();
    */
