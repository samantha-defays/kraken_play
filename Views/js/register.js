'use strict';
document.addEventListener('DOMContentLoaded', function () {

    var registerForm = document.getElementById('register');

    var firstName = registerForm["firstname"];
    var lastName = registerForm["lastname"];
    var day = registerForm["date"];
    var month = registerForm["month"];
    var year = registerForm["year"];
    var address = registerForm["address"];
    var postCode = registerForm["postcode"];
    var city = registerForm["city"];
    var country = registerForm["country"];
    var email = registerForm["email"];
    var password = registerForm["password"];

    function checkFormFields(event) {

        var isValid = true;

        if (firstName.value == "") {
            firstName.classList.add("field-error");
            isValid = false;
        }

        if (lastName.value == "") {
            lastName.classList.add("field-error");
            isValid = false;
        }

        if ((day.value == 1) && (month.value == 1) && (year.value == 2020)) {
            day.classList.add("field-error");
            month.classList.add("field-error");
            year.classList.add("field-error");
            isValid = false;
        }

        if(month.value == 2 && (day.value == 31 || day.value == 30 )) {
            day.classList.add("field-error");
            month.classList.add("field-error");
            isValid = false;
        }

        if (address.value == "") {
            address.classList.add('field-error');
            isValid = false;
        }

        if (postCode.value == "" || postCode.value < 5) {
            postCode.classList.add("field-error");
            isValid = false;
        }

        if (city.value == "") {
            city.classList.add("field-error");
            isValid = false;
        }

        if (country.value == "") {
            country.classList.add("field-error");
            isValid = false;
        }

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

    registerForm.addEventListener('submit', checkFormFields);

});