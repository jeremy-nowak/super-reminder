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

      let doneCheckbox = document.createElement("input");
      doneCheckbox.setAttribute("type", "checkbox");
      doneCheckbox.setAttribute("id", "doneCheckbox");
      doneCheckbox.setAttribute("data-id", element.task["0"]["0"]["id_task"])
      doneCheckbox.value = "Done";
      let doneLabel = document.createElement("label");
      doneLabel.textContent = "Done";

      if (element.task["0"]["0"]["state"] == 1) {
        doneCheckbox.checked = true;
      } 


      let pendingCheckbox = document.createElement("input");
      pendingCheckbox.setAttribute("type", "checkbox");
      pendingCheckbox.setAttribute("id", "pendingCheckbox");
      pendingCheckbox.setAttribute("data-id", element.task["0"]["0"]["id_task"])
      pendingCheckbox.value = "Pending";

      let pendingLabel = document.createElement("label");
      pendingLabel.textContent = "Pending";

      if(element.task["0"]["0"]["state"] == 0){
        pendingCheckbox.checked = true;
      }

      



      let divTaskTodo = document.createElement("div");
      divTaskTodo.setAttribute("id", "divTaskTodo");
      divTaskTodo.setAttribute("name", "divTaskTodo");
      divTaskTodo.setAttribute("class", "divTaskTodo");
      divTaskTodo.appendChild(taskTodo);
      // divTaskTodo.appendChild(pendingCheckbox);
      // divTaskTodo.appendChild(pendingLabel);
      divTaskTodo.appendChild(doneCheckbox);
      divTaskTodo.appendChild(doneLabel);

      displayRegisteredTodo.appendChild(divTaskTodo);

      let taskDone = document.createElement("div");
      taskDone.setAttribute("id", "taskDone");
      taskDone.setAttribute("name", "taskDone");
      taskDone.setAttribute("class", "taskDone");


      doneCheckbox.addEventListener("change", async function (e) {
        e.preventDefault();
      
        let idTask = e.target.getAttribute("data-id");
        let data = new FormData();
        data.append("idTask", idTask);
      
        if (e.target.checked) {
          const response = await fetch("myList/stateDone", {
            method: "POST",
            body: data
          });
          const result = await response.text();

        } else {
          const response = await fetch("myList/statePending", {
            method: "POST",
            body: data
          });
          const result = await response.text();

        }

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
  // -----------------------------------------------------------------------------
});




// async function getAllTodo(){

//   const getAllTodo = await fetch("myList/displayTodos");
//   const result = await getAllTodo.json();
//   console.log(result[0]);
//   console.log(result[0].task[0][0].task);

//   const ul = document.createElement("ul");

//   result.forEach(element => {

//     const div = document.createElement("div");
//     div.className = "div";
    
//     const li = document.createElement("li");
//     const title = document.createElement("p");
//     title.textContent = element.list_name;

//     const task = document.createElement("p");
//     task.textContent = result[0].task[0][0].task;


//     const doneCheckbox = document.createElement("input");
//     doneCheckbox.setAttribute("type", "checkbox");
    
//     li.appendChild(title);
//     li.appendChild(task);
//     li.appendChild(doneCheckbox);
//     div.appendChild(li);
//     ul.appendChild(div);

    
//   });
//   displayRegisteredTodo.appendChild(ul);
// } 
// getAllTodo()

