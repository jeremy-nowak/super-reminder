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
    require_once "src/View/connexion.php";
}, "loginForm");

$router->map( 'GET', '/register', function(){
    require_once "src/View/inscription.php";
}, "registerForm");

$router->map( 'GET', '/profil', function(){
    require_once "src/View/profil.php";
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
    $authControleur = new AuthController();
    $authControleur->logoutAuth();
}, 'logout');



$router->map( 'POST', '/login/loginValidate',function(){

    $authControleur = new AuthController();
    $authControleur->authLogin();
},  "loginValidate");



$router->map( 'POST', '/profil/updateProfil',function(){
    $authControleur = new AuthController();
    $authControleur->updateProfil();
},  "updateProfil");




















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