document.addEventListener("DOMContentLoaded", function () {

    console.log("scriptProfil.js loaded");

    let login_form = document.querySelector("#login_form");
    let login_profil = document.querySelector("#login_profil");
    let password_profil = document.querySelector("#password_profil");
    let password_profil_conf = document.querySelector('#password_profil_conf');
    let error_password = document.querySelector('#error_password');
    let error_password_conf = document.querySelector('#error_password_conf')

    let submit_profil = document.querySelector("#submit_profil");

    async function login_check(login_profil) {
        let login_profil_value = login_profil.value;
  
        console.log(login_profil);
        console.log(login_form);
        if (login_profil_value.trim() === "") {
          login_profil.style.backgroundColor = "red";
          login_profil.style.borderColor = "red";
        } else {
          login_profil.style.backgroundColor = "initial";
          login_profil.style.borderColor = "initial";
        }
  
        let data = new FormData(login_form);
        data.append("loginCheck", "ok");
  
        let response = await fetch("register/verifLog", {
          method: "POST",
          body: data,
        });
  
        let result = (await response.text()).trim();
        console.log(result);
        if (result === "existant") {
          // if (response === "existant") {
          error_profil.innerHTML = "Login unavailable";
          login_profil.style.borderColor = "red";
          login_profil.style.backgroundColor = "red";
        } else if (result === "inexistant") {
          login_profil.style.borderColor = "initial";
          login_profil.style.backgroundColor = "initial";
          error_profil.innerHTML = "";
        }
      }

      function password_conf_check(password_profil_conf) {

        let password_profil_conf_value = password_profil_conf.value;

        if (password_profil_conf_value.trim() === "") {
          password_profil_conf.style.backgroundColor = "red";
          password_profil_conf.style.borderColor = "red";
        }
        else{
          password_profil_conf.style.backgroundColor = "initial";
          password_profil_conf.style.borderColor = "initial";
        }
      }

      function password_check(password_profil) {

        const regexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        let passwordValue = password_profil.value;
  
        error_password.innerHTML = "";
        error_password_conf.innerHTML = "";

          if (passwordValue.trim() === "") {
            password_profil.style.backgroundColor = "red";
            error_password.innerHTML = "You need to type a password";
          }
          else{
            password_profil.style.backgroundColor = "initial";
            password_profil.style.borderColor = "initial"; 
            if(regexPassword.test(passwordValue)){
              password_profil.style.backgroundColor = "initial";
              password_profil.style.borderColor = "initial";
            } 
            else{
              error_password.innerHTML = "Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character:"
            }
          }
      }
      async function update(login_form){
        let data = new FormData(login_form);
        data.append("update", "ok");
  
        let response = await fetch("profil/updateProfil", {
          method: "POST",
          body: data,
        });
  
        let result = (await response.text()).trim();
        console.log(result);
        if (result === "update accomplished") {
          setTimeout( result, 2000)

          
          
        }
      }



password_profil.addEventListener("blur", function(e){
  e.preventDefault()
  password_check(password_profil, password_profil_conf)
})

password_profil_conf.addEventListener('blur', function(e){
  e.preventDefault();
  password_conf_check(password_profil_conf)
})

login_profil.addEventListener("blur", function () {

    login_check(login_profil);
});

login_form.addEventListener("submit", function (e) {
    e.preventDefault();

    update(login_form);


});
      
      
});
