document.addEventListener("DOMContentLoaded", function () {


    let myList_form_title = document.querySelector('#myList_form_title');
    let task_list = document.querySelector('#task_list');
    let submit_form_title = document.querySelector('#submit_form_title');
    let displayFormTodo = document.querySelector('#displayFormTodo');



    async function addTitle() {
        let task_list_value = task_list.value.trim();
        console.log(task_list_value)

        let titleDiv = document.createElement("div");
        
        
        let titleP = document.createElement("p");

        titleP.innerHTML = task_list_value

        titleDiv.appendChild(titleP)

        displayFormTodo.appendChild(titleDiv)

        let todoSelect = document.createElement("select");
        let todoOption = document.createElement("option");
        let todoOption1 = document.createElement("option");

            todoOption1.value = "1";
            todoOption1.textContent = "Comon"

            todoOption.value = "0";
            todoOption.textContent = "Priority";

            todoSelect.appendChild(todoOption);
            todoSelect.appendChild(todoOption1);

            titleDiv.appendChild(titleP);
            titleDiv.appendChild(todoSelect)

            displayFormTodo.appendChild(titleDiv)

    }
    
    function displayTodoList(){
        
        let todoDiv = document.createElement("div");
        let todoP = document.createElement("p");
        let todoSelect = document.createElement("select");
        let todoOption = document.createElement("option");
        let todoOption1 = document.createElement("option");

        todoDiv.setAttribute("className", "todos" )

            todoOption1.value = "1";
            todoOption1.textContent = "Comon"

            todoOption.value = "0";
            todoOption.textContent = "Priority";

            todoSelect.appendChild(todoOption);
            todoSelect.appendChild(todoOption1);

            todoDiv.appendChild(todoP);
            todoDiv.appendChild(todoSelect)

            displayFormTodo.appendChild(todoDiv)




    }

     async function displayTodoForm(){

        let TodoFOrm = fetch("myList/formTodo")



    }
    

    function createTodo(task_list, ){


    }

    displayTodoList()

myList_form_title.addEventListener('submit', function(e){
    e.preventDefault();

addTitle()

})










    















})
