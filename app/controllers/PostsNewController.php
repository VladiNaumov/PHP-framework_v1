<?php

namespace app\controllers;


class PostsNewController extends App
{

    // public $layout = 'main';



    public function indexAction()
    {
        echo ' PostsNewController::index ';
    }

    public function postNewAction()
    {
       echo 'PostsNewController::postNewAction';
    }

    public function testAction()
    {
        echo 'test::testAction';
    }

    public function before(){

        echo 'PostsNewController::before';
    }

}