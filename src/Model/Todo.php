<?php
namespace App\Model;
use PDO;
use App\Model\Database;

class Todo extends Database{

public function todoDisplay(){

    $stmt = "SELECT * FROM task WHERE id_user = :id_user ";
    $stmt = $this->bdd->prepare($stmt);
    $stmt->execute(array(
        'id_user' => $_SESSION['id']
    ));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
    
}

public function registerListName($titleName, $userId){

    $statement = "SELECT * FROM `list_name` WHERE list_name = :list_name";
    $statement = $this->bdd->prepare($statement);
    $statement->execute([
        'list_name' => $titleName
     ]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);
      return $result;
      echo $result;





    

        // $stmt = "INSERT INTO `list_name` (id_user, list_name) VALUES (:id_user, :list_name)";
        // $stmt = $this->bdd->prepare($stmt);
        // $stmt->execute([
        //     'list_name' => $titleName,
        //     'id_user' => $userId
        // ]); 

}

public function getIdList($titleName){


    $statement = "SELECT id_list FROM list_name WHERE list_name = :list_name";
    $statement = $this->bdd->prepare($statement);
    $statement->execute([
        'list_name' => $titleName
    ]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result;

}

public function registerTask(){
            
        $stmt = "INSERT INTO `task` (`id_list`, `task`, `priority`, `start_date`, `end_date`, `state`) VALUES (:id_list, :task, :priority, :start_date, :end_date, :state)";
        $stmt = $this->bdd->prepare($stmt);
        $stmt->execute(array(
            'id_list' => $_POST['id_list'],
            'task' => $_POST['task'],
            'priority' => $_POST['priority'],
            'start_date' => $_POST['start_date'],
            'end_date' => $_POST['end_date'],
            'state' => $_POST['state']
        ));

    
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

public function addTodo($id, $list, $title, $description, $start_date, $end_date, $state){

    $stmt = "INSERT INTO `todo` WHERE id = $id ";


}





}



?>