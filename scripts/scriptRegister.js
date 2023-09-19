document.addEventListener("DOMContentLoaded", function () {
  console.log(window.location.pathname.toString());
  // ----------------------------------------------------------------------------------------------
  // --------------------------------Register Section Start----------------------------------------
  // ----------------------------------------------------------------------------------------------

  
    let form_register = document.querySelector("#register_form");
    let login = document.querySelector("#login");
    let password = document.querySelector("#password");
    let error_password = document.querySelector("#error_password");
    let password_conf = document.querySelector("#password_conf");
    let error_password_conf = document.querySelector("#error_password_conf");
    let error_login = document.querySelector("#error_login");
    let error_submit = document.querySelector("#error_submit");

    // ----------------------------------------------------------------------------------------------
    // --------------------------------Verification of form inputS start--------------------------
    // ----------------------------------------------------------------------------------------------

    async function login_check(login) {
      let loginValue = login.value;

      if (loginValue.trim() === "") {
        login.style.backgroundColor = "red";
        login.style.borderColor = "red";
      } else {
        login.style.backgroundColor = "initial";
        login.style.borderColor = "initial";
      }

      let data = new FormData(form_register);
      data.append("loginCheck", "ok");
      let response = await fetch("register/verifLog", {
        method: "POST",
        body: data,
      });

      let result = (await response.text()).trim();
      if (result === "existant") {
        // if (response === "existant") {
        error_login.innerHTML = "Login unavailable";
        login.style.borderColor = "red";
        login.style.backgroundColor = "red";
      } else if (result === "inexistant") {
        login.style.borderColor = "initial";
        login.style.backgroundColor = "initial";
        error_login.innerHTML = "";
      }
    }

    function password_check(password) {

      const regexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
      let passwordValue = password.value;

      error_password.innerHTML = "";

        if (passwordValue.trim() === "") {
          password.style.backgroundColor = "red";
          error_password.innerHTML = "You need to type a password";
        }
        else if(regexPassword.test(passwordValue)){
          password.style.backgroundColor = "initial";
          password.style.borderColor = "initial";
        } 
        else{
          error_password.innerHTML = "Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character:"
        }
      
    }

    function password_conf_check(password_conf) {
      let password_confValue = password_conf.value;
      error_password_conf.innerHTML = "";

      if (password_confValue.trim() === "") {
        password_conf.style.backgroundColor = "red";
        error_password_conf.innerHTML = "You need to type a password";
      } else {
        password_conf.style.backgroundColor = "initial";
        password_conf.style.borderColor = "initial";
      }
    }

    // ----------------------------------------------------------------------------------------------
    // --------------------------------Verification of form inputS end-------------------------------
    // ----------------------------------------------------------------------------------------------

    // ----------------------------------------------------------------------------------------------
    // --------------------------------Function register start---------------------------------------
    // ----------------------------------------------------------------------------------------------

    function locationLogin() {
      window.location.href = "login";
    }

    async function register(form_register) {
      let data = new FormData(form_register);
      data.append("register", "ok");
      let response = await fetch('register/registerValidate', {
        method: "POST",
        body: data,

      });
// regler le probleme de la redirection ver ma page login
      
      let result = (await response.text()).trim();
      if (result === "inexistantregisterOK") {
        error_submit.innerHTML = "Congratulation you are registered !";
        setTimeout(() => {
          locationLogin();
        }, 2000);

      } else if (result === "inexistantregisternotOK") {

        error_submit.innerHTML = "Register fail";
      }
    }

    // ----------------------------------------------------------------------------------------------
    // --------------------------------Function end-------------------------------------------------
    // ----------------------------------------------------------------------------------------------

    // ----------------------------------------------------------------------------------------------
    // --------------------------------addEventListener start----------------------------------------
    // ----------------------------------------------------------------------------------------------

    form_register.addEventListener("submit", function (e) {
      e.preventDefault();
      register(form_register);
    });

    login.addEventListener("blur", async function (e) {
      e.preventDefault();

      await login_check(login);
    });

    password.addEventListener("blur", function (e) {
      e.preventDefault();
      password_check(password);
    });

    password_conf.addEventListener("blur", function (e) {
      e.preventDefault();
      password_conf_check(password_conf);
    });

    // ----------------------------------------------------------------------------------------------
    // --------------------------------addEventListener end------------------------------------------
    // ----------------------------------------------------------------------------------------------

});
