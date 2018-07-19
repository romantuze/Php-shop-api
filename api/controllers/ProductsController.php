<?php
namespace api\controllers;

use core\Controller;

class ProductsController extends Controller
{

    public function readoneAction()
    {
        $product = $this->model->readOne($this->route['id']);
        if ($product) {
            $vars = [
                'product' => $product,
            ];
            $this->view->render($vars);
        } else {
            $this->view->message('error', 'Product not found.');
        }
    }

    public function readallAction()
    {
        $products = $this->model->readAll();
        if ($products) {
            $vars = [
                'products' => $products,
            ];
            $this->view->render($vars);
        } else {
            $this->view->message('error', 'Products not found.');
        }
    }

    public function readcategoryAction()
    {
        $products = $this->model->readCategory($this->route['id']);

        if ($products) {
            $vars = [
                'products' => $products,
            ];
            $this->view->render($vars);
        } else {
            $this->view->message('error', 'Products not found');
        }
    }

    public function readcategoryallAction()
    {
        $products = $this->model->readCategoryAll($this->route['id']);
        if ($products) {
            $vars = [
                'products' => $products,
            ];
            $this->view->render($vars);
        } else {
            $this->view->message('error', 'Products not found');
        }
    }

    public function readmanufacturerAction()
    {
        $m        = $this->route['m'];
        $products = $this->model->readManafacturer($m);
        if ($products) {
            $vars = [
                'products' => $products,
            ];
            $this->view->render($vars);
        } else {
            $this->view->message('error', 'Products not found');
        }
    }

    public function readsearchAction()
    {
        $s        = $this->route['s'];
        $products = $this->model->readSearch($s);
        if ($products) {
            $vars = [
                'products' => $products,
            ];
            $this->view->render($vars);
        } else {
            $this->view->message('error', 'Products not found');
        }
    }

}
