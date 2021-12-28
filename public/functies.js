

//Dummy function to test methods
function getData(){
    getMapAndData();
    getWeaterData();
}


//REST: GET request to get the map with the route 
function getMapAndData() {
    fetch("https://sgvd-maps.herokuapp.com/map?latS=51.075824&lonS=5.262364&latE=50.927683&lonE=5.386107")
        .then(response => response.json())
        .then(json => json)
        .then(setMapDurationDistance)
        .catch(err => alert(err));
    
    return true;
}

function setMapDurationDistance(json_data) {
    document.getElementById("duration").innerHTML = "De routebeschrijving duurt " + json_data["duration"] + " minuten.";
    document.getElementById("distance").innerHTML = "De activiteit is " + json_data["distance"] + " kilometer hier vandaan.";
    //Het is nog niet gelukt om de kaart weer te geven.
    //document.getElementById("htmlcode").innerHTML = json_data["html_map"];
}

//REST: GET weather data (using my API key: 06c8cc719b)
function getWeaterData() {
    fetch("https://weerlive.nl/api/json-data-10min.php?key=06c8cc719b&locatie=Beringen")
        .then(response => response.json())
        .then(json => json)
        .then(setWeatherData)
        .catch(err => alert(err));
    
    return true;
}

function setWeatherData(json_data) {
    json_data = json_data["liveweer"][0];
    document.getElementById("plaats").innerHTML = "Het weer in " + json_data["plaats"] + " is als  volgt:";
    document.getElementById("temperatuur").innerHTML = "Het is " + json_data["temp"] + " °C ";
    document.getElementById("gevoelstemperatuur").innerHTML =  "en de gevoelstemperatuur is " + json_data["gtemp"] + " °C.";
    document.getElementById("windrichting").innerHTML = "De windrichting is " + json_data["windr"] + ".";
    document.getElementById("windkmh").innerHTML = "De windsnelheid is " + json_data["windkmh"] + " kilometer per uur.";
    document.getElementById("samenvatting").innerHTML = "Het totale weerbericht voor vandaag is: " + json_data["samenv"] + ".";
}