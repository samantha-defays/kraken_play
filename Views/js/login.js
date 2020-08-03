'use strict';
document.addEventListener('DOMContentLoaded', function () {

    var loginForm = document.getElementById('login-form');

    var email = loginForm["email"];
    var password = loginForm["password"];

    var isValid = true;


    function checkFormFields(event) {

        if (email.value == "") {
            email.classList.add("field-error");
            isValid = false;
        }

        if (password.value == "") {
            password.classList.add("field-error");
            isValid = false;
        }

        if (isValid === false) {
            event.preventDefault();
        }
    }

    loginForm.addEventListener('submit', checkFormFields);

});