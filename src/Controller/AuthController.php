<?php

namespace App\Controller;

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
        $lastname = trim($_POST['lastname']);
        $firstname = trim($_POST['firstname']);
        if ($this->checkLoginAuth($login) === "inexistant") {
            if (
                !empty($password) &&
                !empty($password_conf) &&
                $password === $password_conf &&
                strlen($password) >= 8 &&
                !empty($lastname) &&
                !empty($firstname) &&
                preg_match($regexPassword, $password)
            ) {

                $password = trim($password);
                $password_conf = trim($password_conf);

                if ($password === $password_conf) {

                    $login = htmlspecialchars($login);
                    $password = htmlspecialchars($password);
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $lastname = htmlspecialchars($lastname);
                    $firstname = htmlspecialchars($firstname);

                    $user = new User();
                    $user->register($login, $password, $lastname, $firstname);
                }
            }
        } else {
            echo "Pobleme de condition du register";
        }
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



    public function updateProfil()
    {

        $regexPassword = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
        $login = trim($_POST['login']);
        $password = trim($_POST['password_profil']);
        $password_conf = trim($_POST['password_profil_conf']);
        $lastname = trim($_POST['lastname']);
        $firstname = trim($_POST['firstname']);
        $id = trim($_SESSION["user"]['id']);

        if (
            !empty($password) &&
            !empty($password_conf) &&
            $password === $password_conf &&
            // strlen($password) >= 8 &&
            !empty($lastname) &&
            !empty($firstname)
            // &&
            // preg_match($regexPassword, $password)
        ) {
            $password = trim($password);
            $password_conf = trim($password_conf);

            if (preg_match($regexPassword, $password) && strlen($password) >= 8) {

                if ($password === $password_conf) {
                    $login = htmlspecialchars($login);
                    $password = htmlspecialchars($password);
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $lastname = htmlspecialchars($lastname);
                    $firstname = htmlspecialchars($firstname);
                    $id = htmlspecialchars($id);

                    $user = new User();
                    $user->update($login, $firstname, $lastname, $password, $id);
                }
                else{
                    echo "Problem between input password and password confirmation";
                }
            }
            
            else{
                echo "Problem with password length or characters";
            }
        } else {
            echo "At least one input empty";
        }
    }
}
