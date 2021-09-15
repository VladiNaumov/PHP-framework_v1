<?php

namespace app\controllers;

use vendor\core\base\Controller;

class PageController extends App
{

    public function viewAction()
    {
       echo 'PageController::view';
    }

    public function indexAction()
    {
        echo 'PageController::index ';

    }

}