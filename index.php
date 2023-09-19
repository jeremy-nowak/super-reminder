<?php
require 'vendor/autoload.php';
$router = new AltoRouter();
$router->setBasePath('/super-reminder');
use App\controller;
use App\class;
use App\model;
use App\view;
use App\Controller\AuthController;
use App\Model\User;

$router->map( 'GET', '/', function(){
    require_once "src/View/home.php";
});

$router->map( 'GET', '/login', function(){
    require_once "src/View/login.php";
    require_once "src/View/login.php";
}, "loginForm");

$router->map( 'GET', '/register', function(){
    require_once "src/View/register.php";
}, "registerForm");

$router->map( 'GET', '/profile', function(){
    require_once "src/View/profile.php";
});

$router->map( 'POST', '/register/verifLog', function(){
    $authController = new AuthController();
    $login = $_POST["login"];
    $authController->checkLoginAuth($login);
}, "checkLogin");

$router->map( 'POST', '/register/registerValidate', function(){
    $authModel = new AuthController();
    $login = $_POST["login"];
    $password = $_POST["password"];

    $authModel->register($login, $password);

}, "home");

$router->map('GET', '/logout', function () {
    $authController = new AuthController();
    $authController->logoutAuth();
}, 'logout');

$router->map( 'POST', '/login/loginValidate',function(){

    $authController = new AuthController();
    $authController->authLogin();
    $authController = new AuthController();
    $authController->authLogin();
},  "loginValidate");



$router->map( 'POST', '/profile/updateProfile',function(){
    $authController = new AuthController();
    $authController->updateProfile();
},  "updateProfile");

$router->map( 'GET', '/myList',function(){
    require_once "src/View/myList.php";
}, "myList");

$router->map( 'GET', '/myList/form',function(){
    require_once "src/View/myList.php";
}, "myListForm");

$router->map( 'GET', '/myList/formTodo',function(){
    require_once "src/View/myListFormTodo.php"; 
}, "myListFormTodo");

$router->map( 'GET', '/myList/formList',function(){
    require_once "src/View/myListFormList.php";
}, "myListFormList");



    















// match
$match = $router->match();

// call closure or throw 404 status
if (is_array($match) && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    // no route was matched
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}


?>