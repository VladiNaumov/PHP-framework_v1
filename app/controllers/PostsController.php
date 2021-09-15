<?php

namespace app\controllers;

use vendor\core\base\Controller;

class PostsController extends App
{

    public function indexAction()
    {
       echo 'PostsController::index ';
    }

    public function addAction()
    {
        echo 'PostsController::addAction ';
    }
}