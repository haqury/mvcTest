<?php
/**
 * Created by PhpStorm.
 * User: haqury
 * Date: 06.10.18
 * Time: 14:53
 */

spl_autoload_register(function ($class_name) {
    $class_name = __DIR__ . '/../' . str_replace('\\', '/', $class_name);
    require_once $class_name . '.php';
});
use Controller\Home;
$controller = new Home();
$controller->index();
\Service\ViewRender::render();