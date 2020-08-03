'use strict';
document.addEventListener('DOMContentLoaded', function () {

    //selecting color list items & sections
    var colors = document.querySelectorAll('.color');
    var display = document.getElementById('color-dice');
    var allDice = document.getElementById('dice-board');


    //displaying dice list with selected color
    function displayDiceByColor(data) {
        let dice = JSON.parse(data);

        //hiding the section with all dice
        display.classList.remove('hidden');
        //showing the section with dice sorted by color
        allDice.classList.add('hidden');

        //inserting dice data
        display.innerHTML = `<h2>${dice[0].color}</h2>`;
        for (let i = 0; i < dice.length; i++) {
            display.innerHTML += `<article class="product">
                                 <a href="./product-detail?id=${dice[i].id}"><img src="./Views${dice[i].photo}" alt="${dice[i].name}"></a>      
                                 <h3>${dice[i].name}</h3><span>${dice[i].price} €</span></article>`;
        }

    }

    //getting the chosen color to ask for info in DB
    function getDiceInfoFromColor() {
        let colorName = this.dataset.color;
        let url = './ajax-color';
        let data = {
            colorName: colorName
        };

        $.get(url, data, displayDiceByColor);
    }

    // adding an event listener on list items
    for (let i = 0; i < colors.length; i++) {
        colors[i].addEventListener('click', getDiceInfoFromColor);
    }


});