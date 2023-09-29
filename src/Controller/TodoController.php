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
        $todo->displayLists($id_user);
    }


    // public function controllerDisplayTask(){

    //     $todo = new Todo();
    //     $resultTask = $todo->modelDisplayTask();

    //     return $resultTask;

    // }


    public function ControllerRegisterlistName($titleName, $id_user){

        $titleName = htmlspecialchars($titleName);
        $titleName = trim($titleName);
        $id_user = htmlspecialchars($id_user);
        $id_user = trim($id_user);

        $todo = new Todo();
        $todo->insertList($titleName, $id_user);
    }


    public function ControllerRegisterTask($task, $listId, $priority){

        $priority = htmlspecialchars($priority);
        $priority = trim($priority);
        $task = htmlspecialchars($task);
        $task = trim($task);
        $listId = htmlspecialchars($listId);
        $listId = trim($listId);

        $todo = new Todo();
        $todo->insertTask($task, $listId, $priority);
    }

    public function ControllerDisplayTasks($id_list){

        $id_list = htmlspecialchars($id_list);
        $id_list = trim($id_list);

        $todo = new Todo();
        $resultTask = $todo->selectTasks($id_list);

        return $resultTask;
    }

    public function ControllerDeleteList($id_user, $id_list){

        $id_user = htmlspecialchars($id_user);
        $id_user = trim($id_user);

        $todo = new Todo();
        $todo->deleteList($id_user, $id_list);
    }

    public function ControllerDeleteTask($id_task, $id_list){

        $id_task = htmlspecialchars($id_task);
        $id_list = htmlspecialchars($id_list);

        $todo = new Todo();
        $todo->deleteTask($id_task, $id_list);

    }
    
    public function ControllerUpdateStateTask($idTask, $state){

        $idTask = trim($idTask);
        $state = trim($state);
        
        $idTask = htmlspecialchars($idTask);
        $state = htmlspecialchars($state);

        $todo = new Todo();
        $todo->updateStateTask($idTask, $state);

    }


}

?>



