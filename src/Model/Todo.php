<?php
namespace App\Model;
use PDO;
use App\Model\Database;

class Todo extends Database{

public function todoDisplay(){


    $request = "SELECT * FROM todos WHERE id_user = :id_user ";
    $request = $this->bdd->prepare($request);
    $request->execute(array(
        'id_user' => $_SESSION['id']
    ));
    $result = $request->fetchAll(PDO::FETCH_ASSOC);
    return $result;
    
}

public function addTodo($id, $list, $title, $description, $start_date, $end_date, $state){

    $request = "INSERT INTO `todo` WHERE id = $id ";


}





}



?>