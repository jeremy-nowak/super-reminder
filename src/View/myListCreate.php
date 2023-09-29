<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="scripts/scriptTodo.js"></script>
    <link rel="stylesheet" href="style/style.css">
    <script src="./scripts/scriptHeader.js"></script>
    <link href="https://unpkg.com/nes.css@latest/css/nes.min.css" rel="stylesheet" />
    <title>myList</title>
</head>

<body>
    <?php
    require_once "header.php";
    ?>
        <div class="add_list_div">
        <i class="nes-kirby"></i>
            <form method="post" id="myList_form_title">
                <h1>To do list creation</h1>
                <label for="task_list">List name</label>
                <input type="text" class="task_list" name="task_list" id="task_list">
                <input type="submit" id="submit_form_title" value="Submit">
            </form>
            <i class="nes-mario"></i>
        </div>

        <div>
                <div id="display_lists" class="display_lists">

                </div>
        </div>
    </div>


</body>

</html>