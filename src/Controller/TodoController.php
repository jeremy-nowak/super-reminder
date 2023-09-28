<?php
namespace App\Controller;

use App\Model\Todo;
use App\Model\User;

if (!isset($_SESSION)) {
    session_start();
}

class TodoController{


    public function controllerDisplayTodos(){

        $id_user = $_SESSION["user"]["id_user"];
        $id_user = htmlspecialchars($id_user);
        $id_user = trim($id_user);

        $todo = new Todo();
        $result = $todo->modelDisplayTitle($id_user);

        return $result;
    }


    public function controllerDisplayTask(){

        $todo = new Todo();
        $resultTask = $todo->modelDisplayTask();

        return $resultTask;

    }

}

?>



