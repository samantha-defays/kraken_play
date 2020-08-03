'use strict';
document.addEventListener('DOMContentLoaded', function () {
    var toggleButton = document.querySelector('header span');
    var nav = document.querySelector('header nav');

    function onClickToggleNav() {
        nav.classList.toggle('toggle-nav');
    }

    toggleButton.addEventListener('click', onClickToggleNav);
});