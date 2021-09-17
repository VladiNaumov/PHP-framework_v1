<?php

namespace app\controllers;

use app\models\Main;

class MainController extends App
{
    //public $layout = 'main';

    public function indexAction()
    {

        // пример как сделать что-бы шаблон не подключался
        //$this->layout = false;

        //подключения layout  'test'
        //$this->layout = 'main';
        //$this->layout = 'default';

        //подключения view 'test'
        // $this -> view = 'test';

        $model = new Main();

       // $posts = $model->findAll();
       // debug($posts);

        $title = 'PAGE TITLE';
        $this->set(compact('title'));

    }
}