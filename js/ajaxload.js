var animalContainer = document.getElementById("animal-info");
var btn = document.getElementById("btn");
btn.addEventListener("click", function () {
    var ourRequest = new XMLHttpRequest();
    ourRequest.open("GET","../goudash/json/animals-1.json");
    ourRequest.onload = function () {
        var ourData = JSON.parse(ourRequest.responseText);
        renderHTML(ourData);
    };
    ourRequest.send();
});

function renderHTML(data) {
    var htmlString = "";
    for (i=0; i<data.length; i++) {
        htmlString += "<p>" + data[i].name + " ia a " + data[i].species + "</p>"
    }
    animalContainer.insertAdjacentHTML("beforeend", htmlString);
}



