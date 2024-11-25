document.addEventListener("DOMContentLoaded", function () {
    const registerButton = document.getElementById("register");
    const cancelButton = document.getElementById("cancel-register");
    const loginBox = document.getElementById("login-box");
    const registerBox = document.getElementById("register-box");


    registerButton.addEventListener("click", function () {
        loginBox.style.display = "none";
        registerBox.style.display = "block";
    });


    cancelButton.addEventListener("click", function () {
        registerBox.style.display = "none";
        loginBox.style.display = "block";
    });
});