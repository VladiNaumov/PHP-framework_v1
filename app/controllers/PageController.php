<?php

namespace app\controllers;

class PageController extends App
{
    // public $layout = 'main';

    public function viewAction()
    {
       echo 'PageController::view';
    }

    public function indexAction()
    {
        echo 'PageController::index ';

    }

}