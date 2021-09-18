<?php

namespace app\controllers;

use app\models\Main;

class MainController extends App
{
   // public $layout = 'main';

    public function indexAction()
    {

        // пример как сделать что-бы шаблон не подключался
        //$this->layout = false;

        //подключения layout  'test'
        // $this->layout = 'main';
        //$this->layout = 'default';

        //подключения view 'test'
        // $this -> view = 'test';

        $model = new Main();

         $posts = $model->findAll();
        // $posts = $model->findOne(2);
         //$data = $model ->finBySql("SELECT * FROM posts ORDER BY id DESC LIMIT 2");
        // $data = $model ->finBySql("SELECT * FROM {$model->table} WHERE title LIKE ?", ['%Web%']);
        $data = $model->finLike('Web', 'title');
         debug($data);

        $title = 'PAGE TITLE';
        $this->set(compact('title', 'posts'));

    }
}