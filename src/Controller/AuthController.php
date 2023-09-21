<?php

namespace App\Controller;

use App\Model\Todo;
use App\Model\User;

if (!isset($_SESSION)) {
    session_start();
}

class AuthController
{

    function checkLoginAuth($login)
    {

        $user = new User();
        return $user->checkLogin($login);
    }


    function register()
    {
        $regexPassword = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
        $login = trim($_POST['login']);
        $password = trim($_POST['password']);
        $password_conf = trim($_POST['password_conf']);
        if ($this->checkLoginAuth($login) === "notexisting") {

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

    public function registerListName($listName){

        $userId = $_SESSION["user"]["id_user"];
        $listName = htmlspecialchars($listName);
        $userId = htmlspecialchars($userId);
        $userId = trim($userId);
        $listName = trim($listName);

        if (isset($_SESSION) && $this->checkIdUser($userId) === "existing") {
            $user = new Todo();
            $user->registerListName($listName, $userId);
        }
    }


    public function registerTask(){
        
        $userId = $_SESSION["user"]["id_user"];
        $idList = $_POST["id_list"];
        $task = $_POST["task"];
        $priority = $_POST["priority"];
        $startDate = $_POST["start_date"];
        $endDate = $_POST["end_date"];
        $state = $_POST["state"];

        $userId = htmlspecialchars($userId);
        $idList = htmlspecialchars($idList);
        $task = htmlspecialchars($task);
        $priority = htmlspecialchars($priority);
        $startDate = htmlspecialchars($startDate);
        $endDate = htmlspecialchars($endDate);
        $state = htmlspecialchars($state);

        $userId = trim($userId);
        $idList = trim($idList);
        $task = trim($task);
        $priority = trim($priority);
        $startDate = trim($startDate);
        $endDate = trim($endDate);
        $state = trim($state);

        if (isset($_SESSION) && $this->checkIdUser($userId) === "existing") {
            $user = new Todo();
            $user->registerTask($idList, $task, $priority, $startDate, $endDate, $state);
        }
    }










    public function checkIdUser()
    {

        $userId = trim($_SESSION['user']["id_user"]);
        $userId = htmlspecialchars($userId);
        $user = new User();
        return $user->checkIdUser($userId);
    }

    public function authLogin()
    {

        $login = trim($_POST['login']);
        $password = trim($_POST['password_login']);

        $user = new User();
        $user->login($login, $password);
    }


    public function logoutAuth()
    {
        session_destroy();
        header("Location: ./");
    }


    public function updateProfile()
    {

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
}
