<?php
use Console\App\Controller\IndexController;

if (isset($_GET['action']))
{
    // router
    switch ($_GET['action'])
    {
        case 'about':
            $controllerName = 'IndexController';
            $action = 'aboutAction';
            break;
    }
} else
{
    $controllerName = 'IndexController';
    $action = 'indexAction';
}

$controller = new IndexController();
$controller->indexAction($_REQUEST);
//$controller->$action($_REQUEST);