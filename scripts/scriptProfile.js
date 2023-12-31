document.addEventListener("DOMContentLoaded", function () {

    console.log("scriptProfile.js loaded");

    let login_form = document.querySelector("#login_form");
    let login_profile = document.querySelector("#login_profile");
    let password_profile = document.querySelector("#password_profile");
    let password_profile_conf = document.querySelector('#password_profile_conf');
    let error_password = document.querySelector('#error_password');
    let error_password_conf = document.querySelector('#error_password_conf')
    let success_form_profile = document.querySelector("#success_form_profile");
    let error_form_profile = document.querySelector("#error_form_profile");

    let submit_profile = document.querySelector("#submit_profile");

    async function login_check(login_profile) {
        let login_profile_value = login_profile.value;
  
        console.log(login_profile);
        console.log(login_form);
        if (login_profile_value.trim() === "") {
          login_profile.style.backgroundColor = "red";
          login_profile.style.borderColor = "red";
        } else {
          login_profile.style.backgroundColor = "#222823";
          login_profile.style.borderColor = "#222823";
        }
  
        let data = new FormData(login_form);
        data.append("loginCheck", "ok");
  
        let response = await fetch("register/verifLog", {
          method: "POST",
          body: data,
        });
  
        let result = (await response.text()).trim();
        console.log(result);
        if (result === "existing") {
          error_profile.innerHTML = "Login unavailable";
          login_profile.style.borderColor = "red";
          login_profile.style.backgroundColor = "red";
        } else if (result === "notexisting") {
          login_profile.style.borderColor = "#222823";
          login_profile.style.backgroundColor = "#222823";
          error_profile.innerHTML = "";
        }
      }

      function password_conf_check(password_profile_conf) {

        let password_profile_conf_value = password_profile_conf.value;

        if (password_profile_conf_value.trim() === "") {
          password_profile_conf.style.backgroundColor = "red";
          password_profile_conf.style.borderColor = "red";
        }
        else{
          password_profile_conf.style.backgroundColor = "#222823";
          password_profile_conf.style.borderColor = "#222823";
        }
      }

      function password_check(password_profile) {

        const regexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        let passwordValue = password_profile.value;
  
        error_password.innerHTML = "";
        error_password_conf.innerHTML = "";

          if (passwordValue.trim() === "") {
            password_profile.style.backgroundColor = "red";
            error_password.innerHTML = "You need to type a password";
          }
          else{
            password_profile.style.backgroundColor = "#222823";
            password_profile.style.borderColor = "#222823"; 
            if(regexPassword.test(passwordValue)){
              password_profile.style.backgroundColor = "#222823";
              password_profile.style.borderColor = "#222823";
            } 
            else{
              error_password.innerHTML = "Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character:"
            }
          }
      }

      function indexLocation(){
        window.location = "./"
      }

      async function update(login_form){
        let data = new FormData(login_form);
        data.append("update", "ok");
  
        let response = await fetch("profile/updateProfile", {
          method: "POST",
          body: data,
        });
  
        let result = (await response.text()).trim();

        console.log(result);
        if (result === "update success") {
          success_form_profile.innerHTML = "Update success";
          setTimeout( indexLocation, 2000)
        }
        if (result === "update failed") {
          error_form_profile.innerHTML = "Update failed";
        }
      }



password_profile.addEventListener("blur", function(e){
  e.preventDefault()
  password_check(password_profile, password_profile_conf)
})

password_profile_conf.addEventListener('blur', function(e){
  e.preventDefault();
  password_conf_check(password_profile_conf)
})

login_profile.addEventListener("blur", function () {

    login_check(login_profile);
});

login_form.addEventListener("submit", function (e) {
    e.preventDefault();

    update(login_form);


});
      
      
});
