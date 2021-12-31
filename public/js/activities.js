window.onload = loadActivity(0);

function loadActivity(activityId){
    navigator.geolocation.getCurrentPosition(handleLocationUpdate, err => alert(err));
}

// SOURCE: https://developer.mozilla.org/en-US/docs/Web/API/Geolocation/getCurrentPosition
function handleLocationUpdate(user_pos) {
    var user_crd = user_pos.coords;
    updateMapAndData(user_crd.latitude, user_crd.longitude, "50.927683", "5.386107");
    updateWeatherData("50.927683", "5.386107");
}

//REST: GET request to get the map with the route 
function updateMapAndData(latS, lonS, latE, lonE) {
    fetch(`https://sgvd-maps.herokuapp.com/map?latS=${latS}&lonS=${lonS}&latE=${latE}&lonE=${lonE}`)
        .then(response => response.json())
        .then(json => {
            document.getElementById("duration").innerHTML = "De routebeschrijving duurt " + json["duration"] + " minuten.";
            document.getElementById("distance").innerHTML = "De activiteit is " + json["distance"] + " kilometer hier vandaan.";
            //Het is nog niet gelukt om de kaart weer te geven.
            document.getElementById("map").srcdoc = json["html_map"];
        })
        .catch(err => alert(err));
    
    return true;
}

//REST: GET weather data (using my API key: 06c8cc719b)
function updateWeatherData(lat, lon) {
    fetch(`https://weerlive.nl/api/json-data-10min.php?key=06c8cc719b&locatie=${lat},${lon}`)
        .then(response => response.json())
        .then(json => {
            json = json["liveweer"][0];
            document.getElementById("temperatuur").innerHTML = "Het is " + json["temp"] + " °C ";
            document.getElementById("gevoelstemperatuur").innerHTML =  "en de gevoelstemperatuur is " + json["gtemp"] + " °C.";
            document.getElementById("windrichting").innerHTML = "De windrichting is " + json["windr"] + ".";
            document.getElementById("windkmh").innerHTML = "De windsnelheid is " + json["windkmh"] + " kilometer per uur.";
            document.getElementById("samenvatting").innerHTML = "Het totale weerbericht voor vandaag is: " + json["samenv"] + ".";
        })
        .catch(err => alert(err));
    
    return true;
}