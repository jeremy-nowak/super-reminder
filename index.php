<?php
require 'vendor/autoload.php';
session_start();
$router = new AltoRouter();
$router->setBasePath('/super-reminder');
use App\controller;
use App\class;
use App\model;
use App\view;
use App\Controller\AuthController;
use App\Controller\TodoController;
use App\Model\User;

$router->map( 'GET', '/', function(){
    require_once "src/View/home.php";
});

$router->map( 'GET', '/login', function(){
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

},  "loginValidate");


$router->map( 'POST', '/profile/updateProfile',function(){
    $authController = new AuthController();
    $authController->updateProfile();
},  "updateProfile");

$router->map( 'GET', '/myList',function(){
    require_once "src/View/myList.php";
}, "myList");


$router->map( 'GET', '/myList/getLists',function(){

    $id_user = $_SESSION["user"]["id_user"];
    $todoController = new TodoController();
    $todoController->controllerDisplayLists($id_user);

}, "myListTitle");

$router->map( 'GET', '/myListCreate',function(){
    require_once "src/View/myListCreate.php";
}, "myListCreate");

$router->map('POST', '/myList/registerTitle', function(){
    
    $id_user = $_SESSION["user"]["id_user"];
    $titleName = $_POST["task_list"];
    $todoController = new TodoController();
    $todoController->registerlistName($titleName, $id_user);
    
}, "registerMyList" );


$router->map('POST', '/myList/registerTask', function(){

    $priority = $_POST["priority"];
    $task = $_POST["task_name"];
    $listId = $_POST["list_id"];

    $authController = new TodoController();
    $authController->registerTask($task, $listId, $priority);
    
}, "registerTask" );

$router->map('POST', '/myList/deleteList', function(){

    $id_user = $_SESSION["user"]["id_user"];
    $id_list_name = $_POST["id_list_name"];
    
    $todo = new TodoController();
    $todo->deleteList($id_user, $id_list_name); 

}, "deleteList");


// $router->map( 'GET', '/myList/displayTodos',function(){
//     $todoController = new TodoController();
//     $result = $todoController->controllerDisplayTodos();
//     echo json_encode($result);

// }, "myListForm");



$router->map( 'GET', '/myList/getTasks',function(){
    $id_list = $_GET["id_list"];
    $todoController = new TodoController();
    $resultTask = $todoController->displayTasks($id_list);
    echo json_encode($resultTask);

}, "myListTask");



// $router->map( 'POST', '/myList/stateDone',function(){
// var_dump($_POST);
//     $idTask = $_POST["idTask"];
//     $authController = new AuthController();
//     $authController->controlStateDone($idTask);

// }, "myListstateDone");


// $router->map( 'POST', '/myList/statePending',function(){

//     $idTask = $_POST["idTask"];
//     $authController = new AuthController();
//     $authController->controlStatePending($idTask);

// }, "myLiStstatePending");


















    















// match
$match = $router->match();

// call closure or throw 404 status
if (is_array($match) && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    // no route was matched
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
