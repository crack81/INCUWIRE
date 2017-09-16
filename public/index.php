<?php
require_once '../vendor/autoload.php';
require_once '../app/conf/settings.php';


$app = new \Slim\App;

require_once(ROUTES_PATH.'restapi.php');

$app->run();