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

public function displayLists($id_user){

    $select = "SELECT * FROM list_name WHERE id_user = :id_user ORDER BY date_list_name DESC"; 
    $select = $this->bdd->prepare($select);
    $select->execute([
        ":id_user" => $id_user
    ]);

    $result = $select->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}

// public function modelDisplayTask(){

//     $id_user = $_SESSION["user"]["id_user"];

//     $modelDisplayTitle = new Todo();
//     $modelDisplayTitle->modelDisplayTitle($id_user);

//     for ($i=0; isset($modelDisplayTitle) < $i; $i++) { 

//         $select = "SELECT * FROM task WHERE id_list_name = :id_list_name";
//         $select = $this->bdd->prepare($select);
//         $select->execute([
//             ":id_list_name" => $modelDisplayTitle[$i]["id_list_name"]
//         ]);
    
//         $resultTask = $select->fetchAll(PDO::FETCH_ASSOC);
//         return $resultTask;
//     }
// }

public function insertList ($titleName, $id_user){

    $insert = "INSERT INTO list_name (list_name, id_user) VALUES (:list_name, :id_user)";
    $insert = $this->bdd->prepare($insert);
    $insert->execute([
        ":list_name" => $titleName,
        ":id_user" => $id_user
    ]);

    if ($insert) {
        echo "true";
    } else {
        echo "false";
    }
}
public function insertTask($task, $list_id, $priority){

    $insert = "INSERT INTO task (task, id_list, priority) VALUES (:task, :id_list, :priority)";
    $insert = $this->bdd->prepare($insert);
    $insert->execute([
        ":task" => $task,
        ":id_list" => $list_id,
        ":priority" => $priority
    ]);

    if ($insert) {
        echo "true";
    } else {
        echo "false";
    }
}

public function selectTasks($id_list){

    $select = "SELECT * FROM task WHERE id_list = :id_list ORDER BY priority DESC";
    $select = $this->bdd->prepare($select);
    $select->execute([
        ":id_list" => $id_list
    ]);

    $resultTask = $select->fetchAll(PDO::FETCH_ASSOC);

    return $resultTask;
}


public function deleteList($id_user, $id_list){

    $delete = "DELETE FROM task WHERE id_list = :id_list";
    $delete = $this->bdd->prepare($delete);
    $delete->execute([

        ":id_list" => $id_list
    ]);



    $delete = "DELETE FROM list_name WHERE id_list_name = :id_list_name AND id_user = :id_user";
    $delete = $this->bdd->prepare($delete);
    $delete->execute([

        ":id_list_name" => $id_list,
        ":id_user" => $id_user
    ]);
    
    if ($delete) {
        echo "true";
    } else {
        echo "false";
    }


}

 
    

}
