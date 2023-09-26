<?php
require_once "header.php";
var_dump($_SESSION);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="scripts/scriptTodo.js"></script>
    <link rel="stylesheet" href="style/myListCreate.css">
    <title>myList</title>
</head>

<body>

    <div class="container" id="container">
        <form method="post" id="myList_form_title">
            <h1>To do list creation</h1>
            <label for="task_list">List name</label>
            <input type="text" class="task_list" name="task_list" id="task_list">
            <input type="submit" id="submit_form_title" value="Submit">
            <div id="displayFormTodo" ></div>
        </form>

        <div id="displayRegisteredTodo">        
            <h1>To do list display</h1>
        </div>
    </div>


</body>

</html>