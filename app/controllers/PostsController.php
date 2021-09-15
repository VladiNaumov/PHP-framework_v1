<?php

namespace app\controllers;

class PostsController extends App
{
   // public $layout = 'main';


    public function indexAction()
    {
       echo 'PostsController::index ';
    }

    public function addAction()
    {
        echo 'PostsController::addAction ';
    }
}