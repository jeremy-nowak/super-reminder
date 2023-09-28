let myList_form_title = document.querySelector("#myList_form_title");
let displayLists = document.querySelector("#displayLists");


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
      let li_task = document.createElement("li");
      li_task.classList.add("liTask");
      
      li_task.innerHTML = task.task;
      ul_tasks.appendChild(li_task);

    })

  }


  async function getLists(){


     let response = await fetch('myList/getLists');
    let lists = await response.json();
    displayLists.innerHTML = "";



    lists.forEach((list) => {

        let div = document.createElement("div");
        div.classList.add("list");

        let title = document.createElement("h3");
        title.classList.add("title");
        title.innerHTML = list.list_name;
        
        let btn_add = document.createElement("button");
        btn_add.classList.add("btn_add");
        btn_add.setAttribute("data-id", list.id_list_name);
        btn_add.innerHTML = "Ajouter";
        
        let btn_delete = document.createElement("button");
        btn_delete.classList.add("btn_delete");
        btn_delete.innerHTML = "Supprimer";

        let ul_tasks = document.createElement("ul");
        getTasks(list.id_list_name, ul_tasks);
        
        div.appendChild(title);
        div.appendChild(ul_tasks);
        div.appendChild(btn_add);
        div.appendChild(btn_delete);

        displayLists.appendChild(div);

        
        btn_add.addEventListener("click", function(){
            let form = document.createElement("form");
            form.classList.add("form_add_task");
            form.innerHTML = `
            <input type="text" name="task_name" placeholder="Nom de la tâche">
            <select name="priority">
                <option value="2">urgent</option>
                <option value="1" selected >common</option>  
                <option value="0">not urgent</option>
            <input type="submit" value="Ajouter">
            <input type="hidden" name="list_id" value="${list.id_list_name}">
            `;
            div.appendChild(form);
            form.addEventListener("submit", function(e){
              e.preventDefault();
              addTask(form);
            })
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

