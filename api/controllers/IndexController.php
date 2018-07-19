<?php
namespace api\controllers;

use core\Controller;

class IndexController extends Controller
{

    public function indexAction()
    {
        $this->view->render();
    }

}
