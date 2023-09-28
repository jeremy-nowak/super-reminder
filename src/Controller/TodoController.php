<?php
namespace App\Controller;

use App\Model\Todo;
use App\Model\User;

if (!isset($_SESSION)) {
    session_start();
}

class TodoController{


    public function controllerDisplayLists($id_user){

        $id_user = htmlspecialchars($id_user);
        $id_user = trim($id_user);

        $todo = new Todo();
        $todo->modelDisplayLists($id_user);

    }


    // public function controllerDisplayTask(){

    //     $todo = new Todo();
    //     $resultTask = $todo->modelDisplayTask();

    //     return $resultTask;

    // }


    public function registerlistName($titleName, $id_user){

        $titleName = htmlspecialchars($titleName);
        $titleName = trim($titleName);
        $id_user = htmlspecialchars($id_user);
        $id_user = trim($id_user);

        $todo = new Todo();
        $todo->insertList($titleName, $id_user);
    }


    public function registerTask($task, $listId, $priority){

        $priority = htmlspecialchars($priority);
        $priority = trim($priority);
        $task = htmlspecialchars($task);
        $task = trim($task);
        $listId = htmlspecialchars($listId);
        $listId = trim($listId);

        $todo = new Todo();
        $todo->insertTask($task, $listId, $priority);
    }

    public function displayTasks($id_list){

        $id_list = htmlspecialchars($id_list);
        $id_list = trim($id_list);

        $todo = new Todo();
        $resultTask = $todo->selectTasks($id_list);

        return $resultTask;


    }
    


}

?>



