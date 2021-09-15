<?php

namespace app\controllers;

class MainController extends App
{
    //public $layout = 'main';

    public function indexAction()
    {

        // пример как сделать что-бы шаблон не подключался
        // $this->layout = false;

        //подключения layout  'test'
        //$this->layout = 'main';
        //$this->layout = 'default';

        //подключения view 'test'
        // $this -> view = 'test';

        $name = 'VoVa';
        $hi = 'Hello';
        $colors= [
            'yksi'=>'white',
            'toinen'=>'Black',
        ];
        $this->set(compact('hi','name', 'colors'));



    }
}