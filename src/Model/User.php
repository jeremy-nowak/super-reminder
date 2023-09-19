<?php
namespace App\Model;
use PDO;
use App\Model\Database;


class User extends Database
{

    private $login;
    private $password;
    private $id;

    public function __construct($login = null)
    {
        parent::__construct();
    }
    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getId()
    {
        return $this->id;
    }
    

    public function checkLogin($login)
    {

        $sql = "SELECT login FROM users WHERE login = :login";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute([':login' => $login]);
        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($student) {
            echo "existing";
            return "existing";
        } else {
            echo "notexisting";
            return "notexisting";
        }
    }
    


     public function register($login, $password)
    {
                $sql = "INSERT INTO `users`(`login`, `password`) VALUES (:login, :password)";
                $prepare = $this->bdd->prepare($sql);
                $prepare->execute([':login' => $login, ':password' => $password]);

                echo "registerOK";
                return "registerOK";

        }

    
     public function update($login, $password, $id){
        $login = htmlspecialchars($login);
        $password = htmlspecialchars($password);
        $password = password_hash($password, PASSWORD_DEFAULT);
        


        $sql = "UPDATE `users` SET `login`=:login, `password`=:password WHERE id_user = :id";
        $prepare = $this->bdd->prepare($sql);
        $prepare->execute([':login' => $login,':password' => $password, ':id' => $id]);
        if ($prepare) {
            echo "update success";
            return "update success";
        }
        else{
            echo "update failed";
            return "update failed";
        }
    }


    public function login($login, $password){


        $sql = "SELECT * FROM users WHERE login = :login";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute([':login' => $login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            if (password_verify($password, $user["password"])) {

                $_SESSION["user"]["id_user"] = $user["id_user"];
                $_SESSION["user"]["login"] = $user["login"];
                echo "loginOK";
                return "loginOK";
            } else {
                echo "loginFail";
                return "loginFail";
            }
        } else {
            echo "loginFail";
            return "loginFail";
        }
    }
}

?>