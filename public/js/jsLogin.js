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

    document.getElementById("refreshCaptcha").addEventListener("click", function () {
        document.getElementById("imageCaptcha").src = "./../app/Models/Entities/Captcha.php?" + Date.now();
        document.getElementById("captcha").value = "";
        document.getElementById("resultatCaptcha").innerHTML = "";
    });
});

function verifyCaptcha() {
    var captcha = document.getElementById("captcha").value.trim();

    if (captcha === "") {
        document.getElementById("resultatCaptcha").innerHTML = "Veuillez entrer le captcha.";
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/Projet-WebServeurI/app/Controllers/CaptchaController.php", true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            var response = {};
            try {
                response = JSON.parse(xhr.responseText);
                console.log(response);
            } catch (e) {
                console.error("Erreur de parsing JSON :", e);
                document.getElementById("resultatCaptcha").innerHTML = "Une erreur est survenue.";
                return;
            }

            if (xhr.status === 200) {
                if (response.success) {
                    document.getElementById("resultatCaptcha").innerHTML = "<span class='success'>" + response.message + "</span>";
                } else {
                    document.getElementById("resultatCaptcha").innerHTML = "<span class='error'>" + response.message + "</span>";
                }
            } else {
                console.error("Erreur serveur :", response.message);
                document.getElementById("resultatCaptcha").innerHTML = "Une erreur est survenue côté serveur.";
            }
        }
    };

    xhr.onerror = function() {
        console.error("Erreur réseau.");
        document.getElementById("resultatCaptcha").innerHTML = "Impossible de communiquer avec le serveur.";
    };

    var data = JSON.stringify({ captcha: captcha });
    xhr.send(data);
}

