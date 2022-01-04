// TODO: only for debug
window.onload = loadActivity(0);
window.onload = loadActivityList();

/**************************************************************
*                        Activity list                        *
***************************************************************/

/*
<tr>
    <td>6/12/2021</td>
    <td>Sinterklaas</td>
</tr>
*/

function loadActivityList() {
    var origin = window.location.origin;
    fetch(`${origin}/api/activity/`)
        .then(response => response.json())
        .then(activities_json => {
            var activityList = activities_json["activities"];
            // Convert dateTime string to Date obj
            activityList.forEach(activity => {
                activity.dateTime = new Date(activity.dateTime);
            });

            // Sort on date
            activityList.sort(function (a, b) {
                // Turn your strings into dates, and then subtract them
                // to get a value that is either negative, positive, or zero.
                return a.dateTime - b.dateTime;
            });

            console.log(activityList);
            // Populate html table
            activityList.forEach(activity => {
                // Create html elements
                var parent = document.createElement("tr");
                var date = document.createElement("td");
                var title = document.createElement("td");
                var group = document.createElement("td");

                // Fill elements
                date.innerText = activity.dateTime.toLocaleDateString('nl-BE');
                title.innerText = activity.title;
                group.innerText = activity.group;

                // Set onclick to load activity
                parent.onclick = function () {
                    loadActivity(activity.id);
                };

                // Update html
                parent.append(date, title, group);
                document.getElementById("activity-list-table").append(parent);
            });
        })
        .catch(err => console.error(err));
}



/**************************************************************
*                    Detailed activity info                   *
***************************************************************/

function loadActivity(activityId) {
    getActivityInfo(activityId);
}

function getActivityInfo(id) {
    var origin = window.location.origin;
    fetch(`${origin}/api/activity/${id}`)
        .then(response => response.json())
        .then(activity_json => {
            activity_json = activity_json["activity"];
            updateActivityInfo(activity_json);

            var activity_location = activity_json["location"].replace(/([a-z]|[A-Z]|\s)/g, "").split(",");
            navigator.geolocation.getCurrentPosition(user_pos => {
                handleLocationUpdate(user_pos, activity_location)
            }, err => alert(err));
        })
        .catch(err => alert(err));
}

// SOURCE: https://developer.mozilla.org/en-US/docs/Web/API/Geolocation/getCurrentPosition
function handleLocationUpdate(user_pos, activity_pos) {
    activity_crd = {
        latitude: activity_pos[0],
        longitude: activity_pos[1],
    }
    var user_crd = user_pos.coords;
    updateMapAndData(user_crd.latitude, user_crd.longitude, activity_crd.latitude, activity_crd.longitude);
    updateWeatherData(activity_crd.latitude, activity_crd.longitude);
}

function updateActivityInfo(activity_json) {
    var activity_dateTime = new Date(activity_json["dateTime"]);
    document.getElementById("activity-title").innerHTML = `Activiteit: ${activity_json["title"]}`;
    document.getElementById("activity-date").innerHTML = `datum: ${activity_dateTime.toLocaleDateString('nl-BE')}`;
    document.getElementById("activity-time").innerHTML = `tijd: ${activity_dateTime.toLocaleTimeString('nl-BE')}`;
    document.getElementById("activity-group").innerHTML = `groep: ${activity_json["group"]}`;
    document.getElementById("activity-description").innerHTML = `${activity_json["description"]}`;
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
            document.getElementById("gevoelstemperatuur").innerHTML = "en de gevoelstemperatuur is " + json["gtemp"] + " °C.";
            document.getElementById("windrichting").innerHTML = "De windrichting is " + json["windr"] + ".";
            document.getElementById("windkmh").innerHTML = "De windsnelheid is " + json["windkmh"] + " kilometer per uur.";
            document.getElementById("samenvatting").innerHTML = "Het totale weerbericht voor vandaag is: " + json["samenv"] + ".";
        })
        .catch(err => alert(err));

    return true;
}