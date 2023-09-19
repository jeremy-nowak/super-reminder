<?php
namespace App\Model;
use PDO;
use App\Model\Database;


class User extends Database
{

    // pro $bdd;
    private $login;
    private $firstname;
    private $lastname;
    private $password;
    private $id;

    public function __construct($login = null, $firstname = null, $lastname = null)
    {

        parent::__construct();
    }
    public function getLogin()
    {
        return $this->login;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }
    public function getId()
    {
        return $this->id;
    }
    


    public function checkLogin($login)
    {

        $sql = "SELECT login FROM users WHERE login = :login";
        $statement = $this->bdd->prepare($sql);
        $statement->execute([':login' => $login]);
        $student = $statement->fetch(PDO::FETCH_ASSOC);

        if ($student) {
            echo "existant";
            return "existant";
        } else {
            echo "inexistant";
            return "inexistant";
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
            echo "update accomplished";
            return "update accomplished";
        }
        else{
            echo "update failed";
            return "update failed";
        }
    }


    public function login($login, $password){


        $sql = "SELECT * FROM users WHERE login = :login";
        $statement = $this->bdd->prepare($sql);
        $statement->execute([':login' => $login]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            if (password_verify($password, $user["password"])) {

                $_SESSION["user"]["id_user"] = $user["id_user"];
                $_SESSION["user"]["login"] = $user["login"];
                echo "loginOK";
                return "loginOK";
            } else {
                echo "loginnotOK";
                return "loginnotOK";
            }
        } else {
            echo "loginnotOK";
            return "loginnotOK";
        }
    }
}
  

?>