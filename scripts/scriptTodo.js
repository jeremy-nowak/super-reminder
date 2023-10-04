let myList_form_title = document.querySelector("#myList_form_title");
let displayLists = document.querySelector("#display_lists");


// ----------------------------------
//              Functions        
// ----------------------------------

async function addList(form){
    let data = new FormData(form);
    data.append("addList", "true");
    let response = await fetch('myList/registerTitle', {
        method: 'POST',
        body: data
    });
    let result = await response.text();
    result = result.trim();
    form.reset();
    if(result == "true"){
        getLists();
    }
  }

  async function addTask(form){

    let data = new FormData(form);
    data.append("addTask", "true");
    let response = await fetch('myList/registerTask', {
        method: 'POST',
        body: data
    });
    let result = await response.text();
    form.reset();
    result = result.trim();
    if(result == "true"){
        getLists();
    }
  }


  async function getTasks(id_list_name, ul_tasks){
    let response = await fetch('myList/getTasks?id_list='+ id_list_name
  );
    let tasks = await response.json();
    
    tasks.forEach((task) => {
      console.log(task.task);
      let li_task = document.createElement("li");
      li_task.classList.add("liTask");

      let taskName = document.createElement("p");
      taskName.classList.add("taskName");
      taskName.textContent = task.task; 
      let div_li = document.createElement("div");
      div_li.setAttribute("class","nes-container", "is-rounded");
      div_li.setAttribute("id", "div_li");
  

      let checkbox = document.createElement("input");
      checkbox.setAttribute("type", "checkbox");

      let btn_del_task = document.createElement("button");
      btn_del_task.setAttribute("data-id", task.id_task);
      btn_del_task.classList.add("btn_del_task");
      btn_del_task.textContent = "X";
      


      div_li.appendChild(taskName);
      // div_li.appendChild(checkbox);
      div_li.appendChild(btn_del_task);

      li_task.appendChild(div_li);
      ul_tasks.appendChild(li_task);
// --------------------------------------------------------------------------
      checkbox.addEventListener("click", function(){

        if(checkbox.checked){

          let data = new FormData();
          data.append("id_task", task.id_task);
          data.append("state", "1");

          $request = fetch("myList/updateTask", {
            method: "POST",
            body: data,
          })
        }
        else{
          let data = new FormData();
          data.append("id_task", task.id_task);
          data.append("state", "0");

          $request = fetch("myList/updateTask", {
            method: "POST",
            body: data,
          })
        }
      })

      btn_del_task.addEventListener("click", function(e){
        e.preventDefault();
        
        let data = new FormData();
        data.append("id_task", task.id_task);
        data.append("id_list_name", id_list_name);
        data.append("delete", "true");

        $request = fetch("myList/deleteTask", {
          method: "POST",
          body: data,
        })
        getLists();
      })


    })
  }

  async function getLists(){

    let response = await fetch('myList/getLists');
    let lists = await response.json();
    displayLists.innerHTML = "";

    lists.forEach((list) => {

        let div = document.createElement("div");
        div.classList.add("todo_container", "nes-container", "is-rounded");

        let title = document.createElement("h2");
        title.classList.add("title");
        title.innerHTML = list.list_name;

        let divTuyaux = document.createElement("divTuyaux");
        divTuyaux.classList.add("divTuyaux");
      
        
        let btn_add = document.createElement("button");
        btn_add.classList.add("btn_add", "nes-btn");
        btn_add.setAttribute("data-id", list.id_list_name);
        btn_add.innerHTML = "Add task";
        
        let btn_delete = document.createElement("button");
        btn_delete.classList.add("btn_delete", "nes-btn", "is-error");
        btn_delete.setAttribute("id", "btn_delete");
        btn_delete.innerHTML = "Delete";

        let divButton = document.createElement("div");
        divButton.classList.add("divButton");


        let ul_tasks = document.createElement("div");
        ul_tasks.classList.add("ul_tasks" );
        getTasks(list.id_list_name, ul_tasks);


        divButton.appendChild(btn_add);
        divButton.appendChild(btn_delete);
        div.appendChild(divTuyaux);
        div.appendChild(title);
        div.appendChild(divButton);
        div.appendChild(ul_tasks);

        displayLists.appendChild(div);

        btn_add.addEventListener("click", function(){
            let form = document.createElement("form");
            form.classList.add("form_add_task");
            form.innerHTML = 

            `
            <input type="text" name="task_name" placeholder="Task name">
            <select class="nes-btn" name="priority">
                <option value="2">urgent</option>
                <option value="1" selected >common</option>  
                <option value="0">not urgent</option>
            <input type="submit" value="Add task">
            <input type="hidden" name="list_id" value="${list.id_list_name}">
            `;
            

            div.appendChild(form);
            
            form.addEventListener("submit", function(e){
              e.preventDefault();
              addTask(form);
            })

          })

          btn_delete.addEventListener("click", function(){
            let data = new FormData();
            data.append("id_list_name", list.id_list_name);
            data.append("delete", "true");

            $request = fetch("myList/deleteList", {
              method: "POST",
              body: data,
            })
            getLists();
          })
    });
  }

// ----------------------------------
//       Events et appel de function
// ----------------------------------

getLists();

myList_form_title.addEventListener("submit", function(e){
    e.preventDefault();
    addList(myList_form_title);
})

