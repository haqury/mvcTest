<?php
/**
 * Created by PhpStorm.
 * User: haqury
 * Date: 06.10.18
 * Time: 14:53
 */

require_once __DIR__ . '/Controller/Index.php';
require_once __DIR__ . '/Model/Model.php';
require_once __DIR__ . '/Model/User.php';
require_once __DIR__ . '/Model/Purse.php';
require_once __DIR__ . '/Model/User_Purse__Link.php';
require_once __DIR__ . '/Service/Query.php';
require_once __DIR__ . '/Service/Pdo.php';
require_once __DIR__ . '/Service/ViewRender.php';

$controller = new Index();
ViewRender::render();