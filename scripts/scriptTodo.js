document.addEventListener("DOMContentLoaded", function () {
  let myList_form_title = document.querySelector("#myList_form_title");
  let task_list = document.querySelector("#task_list");
  let submit_form_title = document.querySelector("#submit_form_title");
  let displayFormTodo = document.querySelector("#displayFormTodo");
  let displayRegisteredTodo = document.querySelector("#displayRegisteredTodo");
  displayRegisteredTodo.setAttribute("class", "displayRegisteredTodo");
  myList_form_title.setAttribute("class", "myList_form_title");

  // -------------------------------------------------------------------------------
  // ------------------------------ Function start----------------------------------
  // -------------------------------------------------------------------------------

  function addTitleAndTask() {
    let task_list_value = task_list.value.trim();
    // console.log(task_list_value);

    let formTask = document.createElement("form");
    formTask.setAttribute("class", "formTask");
    formTask.setAttribute("id", "formTask");
    formTask.setAttribute("name", "formTask");
    let formTaskValue = formTask.value;

    let titleP = document.createElement("p");
    titleP.setAttribute("class", "titleP");
    titleP.setAttribute("id", "titleP");
    titleP.setAttribute("name", "titleP");
    titleP.setAttribute("data-id", "titleP");
    titleP.innerHTML = task_list_value;
    formTask.appendChild(titleP);

    let registerTaskBtn = document.createElement("button");
    registerTaskBtn.textContent = "Register Task";
    registerTaskBtn.setAttribute("class", "registerTaskBtn");
    registerTaskBtn.setAttribute("id", "registerTaskBtn");
    registerTaskBtn.setAttribute("name", "registerTaskBtn");

    let inputTodo = document.createElement("input");
    inputTodo.setAttribute("class", "inputTodo");
    inputTodo.setAttribute("id", "inputTodo");
    inputTodo.setAttribute("name", "inputTodo");
    inputTodo.setAttribute("type", "text");

    let todoSelect = document.createElement("select");
    todoSelect.setAttribute("class", "todoSelect");
    todoSelect.setAttribute("id", "todoSelect");
    todoSelect.setAttribute("name", "todoSelect");

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
    todoSelect.appendChild(todoOption2);
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
    registerTaskBtn.addEventListener("click", async function (e) {
      e.preventDefault();

      let data = new FormData(formTask);
      data.append("listName", task_list_value);
      const response = await fetch("myList/registerTask", {
        method: "POST",
        body: data,
      });
      const result = await response.text();

      displayTodo();
    });
  }

  async function displayTodo() {
    displayRegisteredTodo.innerHTML = "";

    const display = await fetch("myList/displayTodos");
    const result = await display.json();
console.log(result);
    for (const element of result) {
      console.log(element.task);

      let formDisplayTask = document.createElement("form");
      formDisplayTask.setAttribute("class", "formDisplayTask");
      formDisplayTask.setAttribute("id", "formDisplayTask");
      formDisplayTask.setAttribute("name", "formDisplayTask");

      let titleP = document.createElement("p");
      titleP.setAttribute("class", "titleP");
      titleP.setAttribute("id", "titleP");
      titleP.setAttribute("name", "titleP");
      titleP.setAttribute("data-id", "titleP");
      titleP.innerHTML = element.list_name;
      formDisplayTask.appendChild(titleP);

      let registerTaskBtn = document.createElement("button");
      registerTaskBtn.textContent = "Register Task";
      registerTaskBtn.setAttribute("class", "registerTaskBtn");
      registerTaskBtn.setAttribute("id", "registerTaskBtn");
      registerTaskBtn.setAttribute("name", "registerTaskBtn");

      let taskTodo = document.createElement("p");
      taskTodo.setAttribute("class", "taskTodo");
      taskTodo.setAttribute("id", "taskTodo");
      taskTodo.setAttribute("name", "taskTodo");
      taskTodo.setAttribute("type", "text");
      taskTodo.innerHTML = element.task["0"]["0"]["task"];

      let todoSelect = document.createElement("select");
      todoSelect.setAttribute("class", "todoSelect");
      todoSelect.setAttribute("id", "todoSelect");
      todoSelect.setAttribute("name", "todoSelect");

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
      todoSelect.appendChild(todoOption2);
      todoSelect.appendChild(todoOption);

      displayRegisteredTodo.appendChild(titleP);
      // displayRegisteredTodo.appendChild(taskTodo);

      // displayRegisteredTodo.appendChild(todoSelect);

      let doneCheckbox = document.createElement("input");
      doneCheckbox.setAttribute("type", "checkbox");
      doneCheckbox.setAttribute("id", "doneCheckbox");
      doneCheckbox.setAttribute("data-id", element.task["0"]["0"]["id_task"])
      doneCheckbox.value = "Done";
      let doneLabel = document.createElement("label");
      doneLabel.textContent = "Done";
      // displayRegisteredTodo.appendChild(doneCheckbox);
      // displayRegisteredTodo.appendChild(doneLabel);

      let pendingCheckbox = document.createElement("input");
      pendingCheckbox.setAttribute("type", "checkbox");
      pendingCheckbox.setAttribute("id", "pendingCheckbox");
      pendingCheckbox.setAttribute("data-id", element.task["0"]["0"]["id_task"])
      pendingCheckbox.value = "Pending";
      let pendingLabel = document.createElement("label");
      pendingLabel.textContent = "Pending";

      // displayRegisteredTodo.appendChild(pendingCheckbox);
      // displayRegisteredTodo.appendChild(pendingLabel);

      let divTaskTodo = document.createElement("div");
      divTaskTodo.setAttribute("id", "divTaskTodo");
      divTaskTodo.setAttribute("name", "divTaskTodo");
      divTaskTodo.setAttribute("class", "divTaskTodo");
      divTaskTodo.appendChild(taskTodo);
      divTaskTodo.appendChild(pendingCheckbox);
      divTaskTodo.appendChild(pendingLabel);
      divTaskTodo.appendChild(doneCheckbox);
      divTaskTodo.appendChild(doneLabel);

      displayRegisteredTodo.appendChild(divTaskTodo);


      // Ajout des eventListener sur les selecteur "done" et "pending"
      // Dans l'eventListener j'ai aouté la création d'un objet pour l'ajouter dans le formData mais j'ai encore une erreur... A voir pour la régler 


      doneCheckbox.addEventListener("change", async function (e) {
        e.preventDefault();
        let idTask = e.target.getAttribute("data-id");
        const idTaskObj = {"id_Task": idTask}
        let data = new FormData(idTaskObj);
        data.append("idTask", idTaskObj);      
        const response = await fetch("myList/MyListCreate", {
          method: "POST",
          body: formData
      });
        const result = await response.text();

      });

      pendingCheckbox.addEventListener("change", async function (e) {
        e.preventDefault();

        const response = await fetch("myList/statePending");
        const result = await response.text();
      });
    }
  }

  displayTodo();

  // -------------------------------------------------------------------------------------
  // ------------------------------Function end-------------------------------------------
  // -------------------------------------------------------------------------------------















  // -------------------------------------------------------------------------------
  // ---------------------------- addEventListener start----------------------------
  // -------------------------------------------------------------------------------





  myList_form_title.addEventListener("submit", async function (e) {
    e.preventDefault();
    let data = new FormData(myList_form_title);
    console.log(data);

    const response = await fetch("myList/registerTitle", {
      method: "POST",
      body: data,
    });
    const result = await response.text();
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
