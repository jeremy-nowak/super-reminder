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
      var_dump($result);
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

public function registerTask(){
    var_dump("utilisation de registerTask");

    $stmt = "INSERT INTO `task` (`id_list`, `task`, `priority`, `date_task`) VALUES (:id_list, :task, :priority, NOW())";
    $stmt = $this->bdd->prepare($stmt);
    $stmt->execute([
        'id_list' => $_SESSION['id_list_name'],
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

    $select = "SELECT * FROM `task`INNER JOIN `list_name` on list_name.id_list_name = task.id_list WHERE :id_user = $id_user";
    $select = $this->bdd->prepare($select);
    $select->execute($id_user);

    $result = $select->fetchAll(PDO::FETCH_ASSOC);
    return $result;

}


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

}
