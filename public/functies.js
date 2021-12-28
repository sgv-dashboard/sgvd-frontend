

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
