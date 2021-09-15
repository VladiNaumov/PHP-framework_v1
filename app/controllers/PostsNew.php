<?php

namespace app\controllers;


class PostsNew extends App
{

    public function indexAction()
    {
        echo ' PostsNew::index ';
    }

    public function postNewAction()
    {
       echo 'PostsNew::postNewAction';
    }

    public function testAction()
    {
        echo 'test::testAction';
    }

    public function before(){

        echo 'PostsNew::before';
    }

}