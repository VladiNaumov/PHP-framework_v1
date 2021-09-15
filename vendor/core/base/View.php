<?php

namespace vendor\core\base;

class View
{
   // текущей маршрут
    private array $route = [];

    //текущий вид
    private string $view;

    //текущий шаблон
    private $layout;

    /**
     * @param array $route
     * @param string $view
     * @param string $layout
     */
    public function __construct(array $route,  $layout = '', string $view ='')
    {
        $this->route = $route;

        // это как переключатель - что-бы шаблон не подключался
        if($layout === false){
            $this->layout=false;
        }else{
            $this->layout = $layout ?: LAYOUT;
        }

        $this->view = $view;

    }

    public function render($vars)
    {
        if (is_array($vars)) {
            extract($vars);
        }

       /*
        * переменная  $file_view хранит полный путь для подключения файла
        * Если URL https://naumdeveloper.site/ то app/views/Main/index.php
        * Если URL https://naumdeveloper.site/demo то app/views/Demo/index.php
        * Если URL https://naumdeveloper.site/page то app/views/Page/index.php
        */
        $file_view = APP."/views/{$this->route['controller']}/{$this->view}.php";



        // ob_start — Включение буферизации вывода
        ob_start();

        if(is_file($file_view)){
            require $file_view;
        }else {
            echo "<p>Не найден вид (app/views) <b>{$file_view}</p>";
        }

        // ob_get_clean — Получить содержимое текущего буфера и удалить его
       $content = ob_get_clean();

        if(false !== $this->layout){

            /*
             * переменная $file_layout хранит полный путь к файлу (шаблонy)
             * Если URL https://naumdeveloper.site/ то app/layouts/default.php
             * Если URL https://naumdeveloper.site/demo то app/layouts/default.php
             * Если URL https://naumdeveloper.site/page то app/layouts/default.php
             */

            $file_layout = APP."/layouts/{$this->layout}.php";

            if(is_file($file_layout)){
                require $file_layout;

            }else{
                echo "<p>Не найден шаблон <b>{$file_layout}</p>";
            }

        }else{
            echo "<p>шаблон отключен опционально <b>";
        }

    }

}