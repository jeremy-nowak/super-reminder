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
        if ($this->checkLoginAuth($login) === "inexistant") {
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
        $id = trim($_SESSION["user"]['id']);

        if (
            !empty($password) &&
            !empty($password_conf) &&
            $password === $password_conf 

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
                    $id = htmlspecialchars($id);

                    $user = new User();
                    $user->update($login, $password, $id);
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