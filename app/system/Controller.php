<?php


class Controller
{
    public $view;
    public $model;
    protected $data;

    public function __construct() {
        $this->view = new View();
        $this->model = new Model();
    }

}