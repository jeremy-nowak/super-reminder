<?php
namespace App\Model;
use PDO;
use PDOException;
abstract class Database{
    protected $bdd;
    public $host;
    public $dbname;
    public $dbUser;
    public $dbPass;

    public function __construct(){

        
        $this->host = 'localhost';
        $this->dbname = 'moduleconnexionb2';
        $this->dbUser = 'root';
        $this->dbPass = '';

        try {
            $this->bdd = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->dbUser, $this->dbPass);
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->bdd->exec("set names utf8");
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            die();
        }
    }

        

        // $pdo = new PDO('mysql:host=localhost;dbname=moduleconnexionb2;charset=utf8', 'root', '');
        // $this->bdd = $pdo;   
        // return $this->bdd;
    }




?>