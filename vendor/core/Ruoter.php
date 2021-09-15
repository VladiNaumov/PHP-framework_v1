<?php

namespace vendor\core;


use vendor\core\base\Controller;

class Ruoter{

    //таблица маршрутов
    protected static array $routes = [];

    //текущий маршрут
     protected static array $route = [];


    //добовление маршрута в таблицу маршрутов
    public static function add($regexp, $route = []) {
        self::$routes[$regexp] = $route;
    }

    //вспомагательный метод для распечатки маршрутов
    public static function gerRoutes(){
        return self::$routes;
    }

    //возвращает текущий маршрут
    public static function getRoute(){
        return self::$route;
    }

    //поиск совпадения маршрута с таблицей маршрута (если найдено возвращает true, если нет false)
    public static  function matchRoute($url){
       
	   foreach (self::$routes as $pattern => $route ) {

            //preg_match — Perform a regular expression match
            if(preg_match("#$pattern#i",$url,$matches))
            {

                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $route[$key] = $value;

                    }
                }

                if(! isset($route['action'])){
                    $route['action'] = 'index';

                }

                $route['controller'] = self::upperCamelCase($route['controller']);
				
                self::$route=$route;

                return true;
            }
        }
        return false;
    }

    //если совпадение было найдено ...... , если нет то выводим ошибку 404 (страница не найдена)
    public static function dispatch($url){

        $url = self::removeQueryString($url);

        if(self::matchRoute($url)) {

            // переменная принимающая String (строку)
            $controller = 'app\controllers\\'. self::$route['controller'];

            if (class_exists($controller)) {

                // переменная принимающая ??????
                $cObj = new $controller(self::$route);

                // переменная принимающая String (строку)
                $action = self::loverCamelCase(self::$route['action']) . 'Action';

                if (method_exists($cObj, $action)){
                    $cObj->$action();
                    $cObj->getView();

                }else{
                    echo " Метод  <b>$controller::$action </b> отсутсвует ";
                }

            }

            else{
                echo " Контроллер <b>$controller</b> отсутсвует ";
            }

        }else{
            http_response_code(404);
            include '404.html';
        }
    }

    //перенаправление URL по корректному маршруту
    protected static function upperCamelCase($name){
        $name = str_ireplace('-', ' ', $name);
        $name = ucwords($name);

        return $name = str_ireplace(' ', '', $name);;
    }

    protected static function loverCamelCase($name){
        return  lcfirst(self::upperCamelCase($name));
    }

    //используется для пагинации (определение явных и не явных get параметров)
    protected static function removeQueryString($url){
        if($url){
           $params = explode('&', $url, 2);
          if(!str_contains($params[0], '=')){
               return rtrim($params[0], '/');

           }else{
               return '';
           }

        }
    }
}