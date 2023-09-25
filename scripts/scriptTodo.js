document.addEventListener("DOMContentLoaded", function () {
  let myList_form_title = document.querySelector("#myList_form_title");
  let task_list = document.querySelector("#task_list");
  let submit_form_title = document.querySelector("#submit_form_title");
  let displayFormTodo = document.querySelector("#displayFormTodo");
  let displayRegisteredTodo = document.querySelector('#displayRegisteredTodo')



// -------------------------------------------------------------------------------
// ------------------------------ Function start----------------------------------
// -------------------------------------------------------------------------------


  function addTitleAndTask() {
    let task_list_value = task_list.value.trim();
    // console.log(task_list_value);

    let formTask = document.createElement("form");
    formTask.setAttribute("class", "formTask");
    formTask.setAttribute("id", "formTask")
    formTask.setAttribute("name", "formTask")
    let formTaskValue = formTask.value;

    let titleP = document.createElement("p");
    titleP.setAttribute("class", "titleP");
    titleP.setAttribute("id", "titleP")
    titleP.setAttribute("name", "titleP")
    titleP.setAttribute("data-id", "titleP")
    titleP.innerHTML = task_list_value;
    formTask.appendChild(titleP);

    let registerTaskBtn = document.createElement("button");
    registerTaskBtn.textContent = "Register Task";
    registerTaskBtn.setAttribute("class", "registerTaskBtn");
    registerTaskBtn.setAttribute("id", "registerTaskBtn")
    registerTaskBtn.setAttribute("name", "registerTaskBtn")
    

    let inputTodo = document.createElement("input");
    inputTodo.setAttribute("class", "inputTodo");
    inputTodo.setAttribute("id", "inputTodo")
    inputTodo.setAttribute("name", "inputTodo")
    inputTodo.setAttribute("type", "text");

    let todoSelect = document.createElement("select");
    todoSelect.setAttribute("class", "todoSelect");
    todoSelect.setAttribute("id", "todoSelect")
    todoSelect.setAttribute("name", "todoSelect")
    
    let todoOption = document.createElement("option");
    let todoOption1 = document.createElement("option");
    let todoOption2 = document.createElement("option");

    
    todoOption1.value = "1";
    todoOption1.textContent = "Low priority task";
    todoOption2.value = "2";
    todoOption2.textContent = "Common task";
    todoOption.value = "3";
    todoOption.textContent = "Urgent task";

    todoSelect.appendChild(todoOption1);
    todoSelect.appendChild(todoOption2)
    todoSelect.appendChild(todoOption);

    formTask.appendChild(titleP);
    formTask.appendChild(inputTodo);

    formTask.appendChild(todoSelect);

    // let doneCheckbox = document.createElement("input");
    // doneCheckbox.setAttribute("type", "checkbox");
    // doneCheckbox.value = "Done";
    // let doneLabel = document.createElement("label");
    // doneLabel.textContent = "Done";
    // // formTask.appendChild(doneCheckbox);Lignes qui ajoute la checkbox "done"
    // // formTask.appendChild(doneLabel);

    // let pendingCheckbox = document.createElement("input");
    // pendingCheckbox.setAttribute("type", "checkbox");
    // pendingCheckbox.value = "Pending";
    // let pendingLabel = document.createElement("label");
    // pendingLabel.textContent = "Pending";
    // formTask.appendChild(pendingCheckbox);Lignes qui ajoute la checkbox "pending"
    // formTask.appendChild(pendingLabel);

    // let deleteButon = document.createElement("button");
    // deleteButon.textContent = "Delete";
    // deleteButon.setAttribute("class", "deleteButon");
    // deleteButon.setAttribute("id", "deleteButon")
    // deleteButon.setAttribute("name", "deleteButon")


    // formTask.appendChild(deleteButon);

    displayFormTodo.appendChild(formTask);
    formTask.appendChild(registerTaskBtn);

    task_list.value = "";



// -------------------------------------------------------------------------------
// -------------------addEventListener inside a function--------------------------
// -------------------------------------------------------------------------------
registerTaskBtn.addEventListener('click' ,async function(e){
  e.preventDefault();

  let data  = new FormData(formTask);
  data.append("listName", task_list_value)
  const response = await fetch("myList/registerTask",{
      method: "POST",
      body: data,
  });
  const result = await response.text()

if (result === "registerTaskOk") {

  const display = await fetch("myList/displayTodos")
  const result = await display.text()

  
}


});
}

// Afficher les listes et les taches avec une fonction qui fetchera

function displayTodo(){


  console.log("DisplayTodo function activated")

  let task_list_value = task_list.value.trim();
    // console.log(task_list_value);

    let formDisplayTask = document.createElement("form");
    formDisplayTask.setAttribute("class", "formDisplayTask");
    formDisplayTask.setAttribute("id", "formDisplayTask")
    formDisplayTask.setAttribute("name", "formDisplayTask")

    let titleP = document.createElement("p");
    titleP.setAttribute("class", "titleP");
    titleP.setAttribute("id", "titleP")
    titleP.setAttribute("name", "titleP")
    titleP.setAttribute("data-id", "titleP")
    titleP.innerHTML = task_list_value;
    formDisplayTask.appendChild(titleP);

    let registerTaskBtn = document.createElement("button");
    registerTaskBtn.textContent = "Register Task";
    registerTaskBtn.setAttribute("class", "registerTaskBtn");
    registerTaskBtn.setAttribute("id", "registerTaskBtn")
    registerTaskBtn.setAttribute("name", "registerTaskBtn")
    

    let inputTodo = document.createElement("input");
    inputTodo.setAttribute("class", "inputTodo");
    inputTodo.setAttribute("id", "inputTodo")
    inputTodo.setAttribute("name", "inputTodo")
    inputTodo.setAttribute("type", "text");

    let todoSelect = document.createElement("select");
    todoSelect.setAttribute("class", "todoSelect");
    todoSelect.setAttribute("id", "todoSelect")
    todoSelect.setAttribute("name", "todoSelect")
    
    let todoOption = document.createElement("option");
    let todoOption1 = document.createElement("option");
    let todoOption2 = document.createElement("option");

    
    todoOption1.value = "1";
    todoOption1.textContent = "Low priority task";
    todoOption2.value = "2";
    todoOption2.textContent = "Common task";
    todoOption.value = "3";
    todoOption.textContent = "Urgent task";

    todoSelect.appendChild(todoOption1);
    todoSelect.appendChild(todoOption2)
    todoSelect.appendChild(todoOption);

    formDisplayTask.appendChild(titleP);
    formDisplayTask.appendChild(inputTodo);

    formDisplayTask.appendChild(todoSelect);

  let doneCheckbox = document.createElement("input");
  doneCheckbox.setAttribute("type", "checkbox");
  doneCheckbox.value = "Done";
  let doneLabel = document.createElement("label");
  doneLabel.textContent = "Done";
  formDisplayTask.appendChild(doneCheckbox);
  formDisplayTask.appendChild(doneLabel);

  let pendingCheckbox = document.createElement("input");
  pendingCheckbox.setAttribute("type", "checkbox");
  pendingCheckbox.value = "Pending";
  let pendingLabel = document.createElement("label");
  pendingLabel.textContent = "Pending";
  formDisplayTask.appendChild(pendingCheckbox);
  formDisplayTask.appendChild(pendingLabel);



  displayRegisteredTodo.appendChild(formTodoDisplay);


}


// -------------------------------------------------------------------------------------
// ------------------------------Function end-------------------------------------------
// -------------------------------------------------------------------------------------

// -------------------------------------------------------------------------------
// ---------------------------- addEventListener start----------------------------
// -------------------------------------------------------------------------------

myList_form_title.addEventListener('submit' ,async function(e){
  e.preventDefault();
    
    let data  = new FormData(myList_form_title);
    console.log(data)
    
    const response = await fetch("myList/registerTitle",{
      method: "POST",
        body: data,
    });
    const result = await response.text()


  });



  myList_form_title.addEventListener("submit", function (e) {
    e.preventDefault();

    addTitleAndTask();
  });

//   registerTaskBtn.addEventListener('click' , function(e){
//     e.preventDefault();

//   })

// -------------------------------------------------------------------------------
// ---------------------------- addEventListener end------------------------------
// -------------------------------------------------------------------------------



// -------------------------------------------------------------------------------
// -------------------Delete task----------------------------------------------------
// -------------------------------------------------------------------------------

// async function deleteTask(e){
//   const taskId = e.target.getAttribute("data-id");
//   const response = await fetch("Todo/deleteTask",{
//     method: "DELETE",
// });

// if (response.ok){
//   e.target.closest(".formTask").remove();
// } else {
//   console.error("failed to delete task");
// }};































});
