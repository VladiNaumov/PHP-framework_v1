<?php

namespace vendor\core;

class Ruoter{

    //таблица маршрутов
    private static array $routes = [];

    //текущий маршрут
    private static array $route = [];


    //добовление маршрута в таблицу маршрутов
    public static function add($regexp, $route = []) {
        self::$routes[$regexp] = $route;
    }


    //поиск совпадения маршрута с таблицей маршрута (если найдено возвращает true, если нет false)
    public static  function matchRoute($url): bool
    {
       
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

           /*
            * переменная $controller хранит полный путь для подключения файла
            * Если URL https://naumdeveloper.site/ то $controller = app\controllers\MainController
            * Если URL https://naumdeveloper.site/posts то $controller = app\controllers\DemoController
            * Если URL https://naumdeveloper.site/page то $controller = app\controllers\PageController
            */

            $controller = 'app\controllers\\'. self::$route['controller'] . 'Controller';

            if (class_exists($controller)) {

                //
                $cObj = new $controller(self::$route);


                // $action - какой метод будет вызван
                $action = self::loverCamelCase(self::$route['action']) . 'Action';


                if (method_exists($cObj, $action)){
                    $cObj->$action();

                    //вызов abstract class Controller -> getView();
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
    protected static function upperCamelCase($name): array|string
    {
        $name = str_ireplace('-', ' ', $name);
        $name = ucwords($name);
        return $name;
    }

    protected static function loverCamelCase($name): string
    {
        return  lcfirst(self::upperCamelCase($name));
    }

    //используется для пагинации (определение явных и не явных get параметров)
    protected static function removeQueryString($url)
    {
        if ($url) {

            $params = explode('&', $url, 2);

            if (!str_contains($params[0], '=')) {
                return rtrim($params[0], '/');

            } else {
                return '';
            }

        }
    }
}