<?php

class IndexView
{
    private $controller;

    function __construct($controller)
    {
        $this->controller = $controller;
    }

    public function index()
    {
        return $this->controller->sayWelcome();
    }
}