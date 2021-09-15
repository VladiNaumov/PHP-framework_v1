<?php


error_reporting(-1);

use vendor\core\Ruoter;

//считывания данных с URL браузера
 $query = rtrim($_SERVER['QUERY_STRING'], '/');


    const WWWW = __DIR__;
    const LAYOUT = 'default';
    define('CORE', dirname( __DIR__) . '/vendor/core');
    define('ROOT', dirname( __DIR__));
    define('APP', dirname( __DIR__) . '/app');

     require '../vendor/libs/functions.php';


    spl_autoload_register(function ($class){
        // debug($class);
        $file = ROOT . '/' . str_ireplace('\\', '/', $class) . '.php';
          if (is_file($file)){
            require_once $file;
        }
    });
	

    //https://naumdeveloper.site/page/view/about получаем:  [controller] => Page  [action] => view  [alias] => about
    Ruoter::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$',['controller' => 'Page']);

    //https://naumdeveloper.site/page/about получаем:  [controller] => Page  [action] => view  [alias] => about
    Ruoter::add('^page/(?P<alias>[a-z-]+)$',['controller' => 'Page', 'action' => 'view']);


    Ruoter::add('^$',['controller' => 'Main','action'=>'index']);
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
