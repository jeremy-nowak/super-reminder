<?php
namespace App\Model;
use PDO;
use App\Model\Database;

class Todo extends Database{

public function checkListName($titleName){
    $statement = "SELECT * FROM `list_name` WHERE list_name = :list_name";
    $statement = $this->bdd->prepare($statement);
    $statement->execute([
        'list_name' => $titleName
     ]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result;
    echo $result;
}

public function registerListNameWithId($titleName, $userId, $list_id){
    
        $stmt = "INSERT INTO `list_name` (id_user, list_name) VALUES (:id_user, :list_name) WHERE id_list_name = $list_id ";
        $stmt = $this->bdd->prepare($stmt);
        $stmt->execute([
            'id_user' => $userId,
            'list_name' => $titleName
        ]); 
    }

    public function registerListName($listName, $userId){

        $stmt = "INSERT INTO `list_name` (id_user, list_name) VALUES (:id_user, :list_name)";
        $stmt = $this->bdd->prepare($stmt);
        $stmt->execute([
            'list_name' => $listName,
            'id_user' => $userId
        ]); 
        if ($stmt) {
            $_SESSION['id_list_name'] = $this->bdd->lastInsertId();
            echo "registerListNameOk";
        }
    }


    

    public function getIdList($titleName){


    $statement = "SELECT id_list_name FROM `list_name` WHERE list_name = :list_name";
    $statement = $this->bdd->prepare($statement);
    $statement->execute([
        'list_name' => $titleName
    ]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result;

}

public function registerTask($listId){
    $stmt = "INSERT INTO `task` (`id_list`, `task`, `priority`, `date_task`) VALUES (:id_list, :task, :priority, NOW())";
    $stmt = $this->bdd->prepare($stmt);
    $stmt->execute([
        'id_list' => $listId,
        'task' => $_POST['inputTodo'],
        'priority' => $_POST['todoSelect']
    ]);
    if ($stmt) {
        echo "registerTaskOk";
    }
    else{
        echo "registerTaskNotOk";
    }
}


public function displayTodos($id_user){

    $select = "SELECT * FROM list_name WHERE id_user = :id_user";
    $select = $this->bdd->prepare($select);
    $select->execute([
        ":id_user" => $id_user
    ]);
    $result = $select->fetchAll(PDO::FETCH_ASSOC);
    
    for($x = 0; isset($result[$x]); $x++){
        $id_list = $result[$x]['id_list_name'];
        $select = "SELECT * FROM task WHERE id_list = :id_list";
        $select = $this->bdd->prepare($select);
        $select->execute([
            ":id_list" => $id_list
        ]);
        if(!isset($result[$x]['task'])){
            $result[$x]['task'] = [];
        }
        array_push($result[$x]['task'], $select->fetchAll(PDO::FETCH_ASSOC));
    }
    return $result;
    
}

public function modelStateDone($idTask){
    $idUser = $_SESSION["user"]["id_user"];
    $update = "UPDATE task SET `state` = `:state` WHERE id_task = :id_task";
    $update = $this->bdd->prepare($update);
    $update->execute([
        ":state" => "1",
        ":id_task" => $idTask
    ]);
    return $update;
}   
public function modelStatePending(){
    $idUser = $_SESSION["user"]["id_user"];
    $update = "UPDATE task SET state = :value WHERE id = :id";
    $update = $this->bdd->prepare($update);
    $update->execute([
        ":value" => 0,
        ":id" => $idUser
    ]);
    return $update;
}   

// public function sortTask($listName){
//     $idList = $this->getIdList($listName)['id_list'];

//     $stmt = "SELECT * FROM task WHERE id_list = :id_list ORDER BY priority ASC";
//     $stmt = $this->bdd->prepare($stmt);
//     $stmt->execute(array(
//         'id_list' => $idList
//     ));
//     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//     return $result;
// }




// public function registerListBdd($listName, $task, $priority){
//     $sql = "INSERT INTO `task` (`list_name`, `task`, `priority`, `start_date`) VALUES (:list_name, :task, :priority, NOW())";
//     $prepare = $this->bdd->prepare($sql);
//     $prepare->execute([':list_name' => $listName, ':task' => $task, ':priority' => $priority]);
//             if ($prepare) {
//         echo "registerListTaskOk";
//         return "registerListTaskOk";
//     }
//     else{
//         echo "registerListTasNotOk";
//         return "registerListTasNotOk";
//     }

//     // Creer cette fonction
// }


// public function deleteTask($id){
//     $stmt = "DELETE FROM `task` WHERE id_task = :id_task";
//     $stmt = $this->bdd->prepare($stmt);
//     $stmt->execute(array(
//         'id_task' => $id
//     ));
// }
}
