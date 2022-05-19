/*SEARCH BY USING A CITY NAME (e.g. athens) OR A COMMA-SEPARATED CITY NAME ALONG WITH THE COUNTRY CODE (e.g. athens,gr)*/
const form = document.querySelector(".top-banner form");
const input = document.querySelector(".top-banner input");
const msg = document.querySelector(".top-banner .msg");
const list = document.querySelector(".ajax-section .cities");
const apiKey = "84dbd77eb59fa78b2b97dcd365f13696";

document.addEventListener("DOMContentLoaded", function(){
    if (localStorage.getItem('favorites') === null) {
        //if no create one
        favorites = [];
    } else {
        //if yes get them
        favorites = JSON.parse(localStorage.getItem('favorites'));
    }
    if(favorites.length != 0){
        favorites.forEach(fav => checkWeather(fav));
    }
});

form.addEventListener("submit", e => {
    e.preventDefault();
    let inputVal = input.value;

    checkWeather(inputVal);
});

function manageFav(id){
    let city = id;
    let favorites;
    //check if we already have favorites
    if (localStorage.getItem('favorites') === null) {
        //if no create one
        favorites = [];
    } else {
        //if yes get them
        favorites = JSON.parse(localStorage.getItem('favorites'));
    }
    if(favorites.includes(city)){
        favorites.splice(favorites.indexOf(city), 1);
        localStorage.setItem('favorites', JSON.stringify(favorites));
    }else{
        favorites.push(city);
        localStorage.setItem('favorites', JSON.stringify(favorites));
    }
}



function checkWeather(inputVal){
    //check if there's already a city
    const listItems = list.querySelectorAll(".ajax-section .city");
    const listItemsArray = Array.from(listItems);

    if (listItemsArray.length > 0) {
        const filteredArray = listItemsArray.filter(element => {
            let content = "";
            //athens,gr
            if (inputVal.includes(",")) {
                //athens,grrrrrr->invalid country code, so we keep only the first part of inputVal
                if (inputVal.split(",")[1].length > 2) {
                    inputVal = inputVal.split(",")[0];
                    content = element
                        .querySelector(".city-name span")
                        .textContent.toLowerCase();
                } else {
                    content = element.querySelector(".city-name").dataset.name.toLowerCase();
                }
            } else {
                //athens
                content = element.querySelector(".city-name span").textContent.toLowerCase();
            }
            return content == inputVal.toLowerCase();
        });

        if (filteredArray.length > 0) {
            msg.textContent = `You already know the weather for ${
        filteredArray[0].querySelector(".city-name span").textContent
      } ...otherwise be more specific by providing the country code as well 😉`;
            form.reset();
            input.focus();
            return;
        }
    }

    //ajax here
    const url = `https://api.openweathermap.org/data/2.5/weather?q=${inputVal}&appid=${apiKey}&units=metric`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            const { main, name, sys, weather } = data;
            const icon = `https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/${
        weather[0]["icon"]
      }.svg`;

            const li = document.createElement("li");
            li.classList.add("city");
            const markup = `
        <h2 class="city-name" data-name="${name},${sys.country}">
          <span><a href="forecast.html?city=${inputVal}&apiKey=${apiKey}" target="_blank">${name}</a></span>
          <sup>${sys.country}</sup>
        </h2>
        <br>
        <button class = "fav" id="${inputVal}" onclick="manageFav(this.id)">Add To Favorite?</button>
        <div class="city-temp">${Math.round(main.temp)}<sup>°C</sup></div>
        <figure>
          <img class="city-icon" src="${icon}" alt="${
        weather[0]["description"]
      }">
          <figcaption>${weather[0]["description"]}</figcaption>
        </figure>
      `;
            li.innerHTML = markup;
            list.appendChild(li);
        })
        .catch(() => {
            msg.textContent = "Please search for a valid city 😩";
        });

    msg.textContent = "";
    form.reset();
    input.focus();
}