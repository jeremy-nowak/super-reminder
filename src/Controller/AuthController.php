<?php

namespace App\Controller;

use App\Model\Todo;
use App\Model\User;

if (!isset($_SESSION)) {
    session_start();
}

class AuthController{

    function ControllerCheckLoginAuth($login){

        $user = new User();
        return $user->checkLogin($login);
    }


    function ControllerRegister(){
        $regexPassword = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
        $login = trim($_POST['login']);
        $password = trim($_POST['password']);
        $password_conf = trim($_POST['password_conf']);
        if ($this->ControllerCheckLoginAuth($login) === "notexisting") {

            if (
                !empty($password) &&
                !empty($password_conf) &&
                $password === $password_conf &&
                strlen($password) >= 8 &&
                preg_match($regexPassword, $password)
            ) {

                $password = trim($password);
                $password_conf = trim($password_conf);

                if ($password === $password_conf) {

                    $login = htmlspecialchars($login);
                    $password = htmlspecialchars($password);
                    $password = password_hash($password, PASSWORD_DEFAULT);


                    $user = new User();
                    $user->register($login, $password);
                }
            }
        } else {
            echo "Register failed";
        }
    }

    // public function registerListName($listName){

    //     $userId = $_SESSION["user"]["id_user"];
    //     $listName = htmlspecialchars($listName);
    //     $userId = htmlspecialchars($userId);
    //     $userId = trim($userId);
    //     $listName = trim($listName);

    //     if (isset($_SESSION) && $this->checkIdUser($userId) === "existing") {
    //         $user = new Todo();
    //         $user->registerListName($listName, $userId);
    //     }




        
    // }


    // public function registerListName($listName){
    //     $userId = $_SESSION["user"]["id_user"];
    //     $listName = htmlspecialchars($listName);
    //     $userId = htmlspecialchars($userId);
    //     $userId = trim($userId);
    //     $listName = trim($listName);
    
    //     var_dump($_POST);
    //     // Vérifiez si l'utilisateur existe déjà
    //     if ($this->checkIdUser($userId) === "existing") {
    //         $todo = new Todo();
    //         // var_dump("Vérifiez si la liste de tâches existe déjà");
    //         $existingList = $todo->checkListName($listName);
            
    //         if ($existingList) {
    //             // var_dump("La liste de tâches existe déjà, récupérez l'ID");
    //             $_SESSION['id_list_name'] = $existingList['id_list_name'];
                
    //         } else {
                
    //             // var_dump("La liste de tâches n'existe pas, créez-la");
    //             $todo->registerListName($listName, $userId);
    //         }
    //     }
    // }
    

    // public function registerTask($task, $titleName){
        
    //     $userId = $_SESSION["user"]["id_user"];
    //     $priority = $_POST["todoSelect"];

    //     $userId = htmlspecialchars($userId);
    //     $titleName = htmlspecialchars($titleName);
    //     $task = htmlspecialchars($task);
    //     $priority = htmlspecialchars($priority);

    //     $userId = trim($userId);
    //     $titleName = trim($titleName);
    //     $task = trim($task);
    //     $priority = trim($priority);

    //     if (isset($_SESSION) && $this->checkIdUser($userId) === "existing") {
    //         $todo = new Todo();
    //         if ($todoInfo = $todo->checkListName($titleName)) {
    //             $listId = $todoInfo["id_list_name"];
    //             $todo->registerTask( $listId, $task, $priority);
    //         }
    //     }
    // }

    
    // public function checkListName($listName){
    //     $listName = htmlspecialchars($listName);
    //     $listName = trim($listName);
    //     $todo = new Todo();
    //     return $todo->checkListName($listName);
    // }


    public function checkIdUser(){

        $userId = trim($_SESSION['user']["id_user"]);
        $userId = htmlspecialchars($userId);
        $user = new User();
        return $user->checkIdUser($userId);
    }

    public function authLogin(){

        $login = trim($_POST['login']);
        $password = trim($_POST['password_login']);

        $user = new User();
        $user->login($login, $password);
    }


    public function logoutAuth(){
        session_destroy();
        header("Location: ./");
    }


    public function updateProfile(){

        $regexPassword = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
        $login = trim($_POST['login']);
        $password = trim($_POST['password_profile']);
        $password_conf = trim($_POST['password_profile_conf']);

        $id = trim($_SESSION["user"]['id_user']);

        if (
            !empty($password) &&
            !empty($password_conf) &&
            $password === $password_conf

        ) {
            $password = trim($password);
            $password_conf = trim($password_conf);

            if (preg_match($regexPassword, $password) && strlen($password) >= 8) {

                if ($password === $password_conf) {
                    $login = htmlspecialchars($login);
                    $password = htmlspecialchars($password);
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $id = htmlspecialchars($id);

                    $user = new User();
                    $user->update($login, $password, $id);
                } else {
                    echo "Problem between input password and password confirmation";
                }
            } else {
                    echo "Problem with password length or characters";
            }
        } else {
            echo "At least one input empty";
        }
    }


    // public function displayTodos(){

    //     $id_user = $_SESSION["user"]["id_user"];
    //     $todo = new Todo();
    //     $result = $todo->modelDisplayTodos($id_user);

    //     return $result;


}

    // public function controlStateDone($idTask){

    //     $idTask = htmlspecialchars($idTask);
    //     $idTask = trim($idTask);

    //     $todo = new Todo();
    //     $result = $todo->modelStateDone($idTask);
        
    //     return $result;
    // }

    // public function controlStatePending($idTask){
    //     $idTask = htmlspecialchars($idTask);
    //     $idTask = trim($idTask);
    //     $todo = new Todo();
    //     $result = $todo->modelStatePending($idTask);

    //     return $result;

    // }


















    












































