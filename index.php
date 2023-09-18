<?php
require 'vendor/autoload.php';
$router = new AltoRouter();

$router->setBasePath('/super-reminder/');

$router->map( 'GET', '/', function(){
    require_once "src/View/home.php";
});
?>
