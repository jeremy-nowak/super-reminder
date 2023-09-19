<?php
namespace App\Model;
use PDO;
use App\Model\Database;

class Todo extends Database{

public function todoDisplay(){


    $stmt = "SELECT * FROM todos WHERE id_user = :id_user ";
    $stmt = $this->bdd->prepare($stmt);
    $stmt->execute(array(
        'id_user' => $_SESSION['id']
    ));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
    
}

public function addTodo($id, $list, $title, $description, $start_date, $end_date, $state){

    $stmt = "INSERT INTO `todo` WHERE id = $id ";


}





}



?>