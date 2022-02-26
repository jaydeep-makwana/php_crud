const signUpPass = document.getElementById("showPassword");
const pass = document.getElementById("password");
const cPass = document.getElementById("cPassword");

signUpPass.addEventListener("click", () => {
    if (pass.type == "password" && cPass.type == "password") {
        pass.type = "text";
        cPass.type = "text";
    } else {
        pass.type = "password";
        cPass.type = "password";
    }
    
});



        