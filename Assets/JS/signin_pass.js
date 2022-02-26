const signInPass = document.getElementById("signInPass");
const pass = document.getElementById("password");
signInPass.addEventListener("click", () => {
            if (pass.type == "password" ) {
                pass.type = "text";
            } else {
                pass.type = "password";
            }

        });