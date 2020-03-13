<?php
require_once __DIR__.'/../src/app/Model/indexModel.php';
require_once __DIR__.'/../src/app/Controller/IndexController.php';
require_once __DIR__.'/../src/app/View/indexView.php';

$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'],'/')) : '/';

// handle root requests
if ($url == '/')
{
    $indexModel = New IndexModel();
    $indexController = New IndexController($indexModel);
    $indexView = New IndexView($indexController);

    print $indexView->index();
}else{
// handle other than root request
}