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
    
    <div class="giga_container">

    <div class="header_container">
    <?php
    require_once "header.php";
    ?>
    <div class="cloud">
        <div class="tiny_cloud1"></div>
        <div class="tiny_cloud2" ></div>
        <div class="tiny_cloud3" ></div>
        <div class="tiny_cloud4" ></div>
        <div class="tiny_cloud5" ></div>
        <div class="tiny_cloud6" ></div>

    </div>
    </div>

        <div class="add_list_div">
            <div class="gestion_mario">

                <i class="nes-mario"></i>
            </div>

            <div class="gestion_kirby">
            <i id="nes-kirby" class="nes-kirby"></i>
            </div>

            <form method="post" id="myList_form_title" class="myList_form_title">
               <h1 id="divH1"> Create your task</h1>
                <label for="task_list">List name</label>
                
                <input type="text" class="task_list" name="task_list" id="task_list">
                <input type="submit" id="submit_form_title" value="Submit">
                
            </form>

        </div>

        <div>
                <div id="display_lists" class="display_lists"></div>
        </div>
    </div>


</body>

</html>