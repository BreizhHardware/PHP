function checkMailMatch(mailContainer, mailConfirmContainer, signupButton) {
    if (mailContainer.value !== mailConfirmContainer.value) {
        signupButton.classList.add("disabled");
        document.getElementById("mail-error").innerHTML = "Emails don't match";
    } else {
        signupButton.classList.remove("disabled");
        document.getElementById("mail-error").innerHTML = "";
    }
}

function checkPasswordMatch(passwordContainer, passwordConfirmContainer, signupButton) {
    if (passwordContainer.value !== passwordConfirmContainer.value) {
        signupButton.classList.add("disabled");
        document.getElementById("password-error").innerHTML = "Passwords don't match";
    } else {
        signupButton.classList.remove("disabled");
        document.getElementById("password-error").innerHTML = "";
    }
}

document.addEventListener("DOMContentLoaded", function() {
    const mailContainer = document.getElementById("mail");
    const mailConfirmContainer = document.getElementById("mailConfirmation");
    const passwordContainer = document.getElementById("password");
    const passwordConfirmContainer = document.getElementById("passwordConfirmation");
    const signupButton = document.getElementById("signupButton");

    mailContainer.addEventListener("keyup", function() {
        checkMailMatch(mailContainer, mailConfirmContainer, signupButton);
    });

    mailConfirmContainer.addEventListener("keyup", function() {
        checkMailMatch(mailContainer, mailConfirmContainer, signupButton);
    });

    passwordContainer.addEventListener("keyup", function() {
        checkPasswordMatch(passwordContainer, passwordConfirmContainer, signupButton);
    });

    passwordConfirmContainer.addEventListener("keyup", function() {
        checkPasswordMatch(passwordContainer, passwordConfirmContainer, signupButton);
    });
});