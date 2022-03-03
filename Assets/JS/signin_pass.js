const signInPass = document.getElementById("signInPass");
const pass = document.getElementById("password");
signInPass.addEventListener("click", () => {
    if (pass.type == "password") {
        pass.type = "text";
    } else {
        pass.type = "password";
    }

});

const asignInPass = document.getElementById("asignInPass");
const apass = document.getElementById("apassword");
asignInPass.addEventListener("click", () => {
    if (apass.type == "password") {
        apass.type = "text";
    } else {
        apass.type = "password";
    }

});