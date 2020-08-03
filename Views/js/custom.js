'use strict';
document.addEventListener('DOMContentLoaded', function () {

    // selecting all available paints & the svg dice
    var colorBox = document.querySelector('.custom > article');
    var colorPalette = ["#000", "#3a2c23", "#4c181c", "#c02c2c", "#a84a26", "#e75b28", "#faac26", "#f8c399", "#d6cda4", "#a5c2a4", "#8aaf3b", "#1d7248", "#173d28", "#2c5589", "#0182c3", "#63839a", "#cdd2e6", "#d7818a", "#fff"];
    var customColor = document.getElementById("customColor");

    var dice = document.querySelector('#svg-dice path');


    function changeDiceColor() {

        // changing svg color
        dice.style.fill = this.dataset.color;
        customColor.value = this.dataset.color;
    }


    //generating color discs
    for (let i = 0; i < colorPalette.length; i++) {
        colorBox.innerHTML += "<div class=\"paint\" data-color=\"" + colorPalette[i] + "\" style=\"background-color:" + colorPalette[i] + "\">";
    }

    var paint = document.querySelectorAll('div.paint');

    //event listeners for color discs
    for (let i = 0; i < paint.length; i++) {
        paint[i].addEventListener('click', changeDiceColor);

    }


});