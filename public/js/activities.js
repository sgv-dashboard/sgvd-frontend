window.onload = loadActivityList();
// WARNING: only for debug
// window.onload = loadActivity(0);

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
    fetch(`${origin}/api/activity/upcoming`)
        .then(response => response.json())
        .then(activities_json => {
            var activityList = activities_json["activities"];

            // Sort on date
            activityList.sort(function (a, b) {
                // Convert dateTime string to Date obj
                a_date = new Date(a.dateTime);
                b_date = new Date(b.dateTime);
                // to get a value that is either negative, positive, or zero.
                return a_date - b_date;
            });

            //console.log(activityList);
            // Populate html table
            activityList.forEach(activity => {
                // Create html elements
                var parent = document.createElement("tr");
                var date = document.createElement("td");
                var title = document.createElement("td");
                var group = document.createElement("td");

                // Fill elements
                date.innerText = (new Date(activity.dateTime)).toLocaleDateString('nl-BE');
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
            return activityList;
        })
        .then(activityList => {
            activity = activityList[0];

            // Update activity info
            updateActivityInfo(activity);

            // Get activity position as coordinates
            var activity_location = activity["location"].replace(/([a-z]|[A-Z]|\s)/g, "").split(",");
            activity_crd = {
                latitude: activity_location[0],
                longitude: activity_location[1],
            };

            // Update day/night icon
            fetch(`${origin}/api/sun/day/${activity["dateTime"]}/${activity_crd.latitude}/${activity_crd.longitude}`)
                .then(response => response.json())
                .then(day => {
                    icon = document.getElementById("day-night-indicator");
                    if (day.day == true) {
                        icon.src = "/images/sun.svg";
                    } else {
                        icon.src = "/images/moon.svg";
                    }
                })
                .catch(err => alert(err));

            // Update weather info
            updateWeatherData(activity_crd.latitude, activity_crd.longitude);

            // Update map
            navigator.geolocation.getCurrentPosition(user_pos => {
                handleLocationUpdate(user_pos, activity_crd)
            }, err => alert(err));

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
            // Update activity info
            updateActivityInfo(activity_json);

            // Get activity position as coordinates
            var activity_location = activity_json["location"].replace(/([a-z]|[A-Z]|\s)/g, "").split(",");
            activity_crd = {
                latitude: activity_location[0],
                longitude: activity_location[1],
            };

            // Update day/night icon
            fetch(`${origin}/api/sun/day/${activity_json["dateTime"]}/${activity_crd.latitude}/${activity_crd.longitude}`)
                .then(response => response.json())
                .then(day => {
                    icon = document.getElementById("day-night-indicator");
                    if (day.day == true) {
                        icon.src = "/images/sun.svg";
                    } else {
                        icon.src = "/images/moon.svg";
                    }
                })
                .catch(err => alert(err));

            // Update weather info
            updateWeatherData(activity_crd.latitude, activity_crd.longitude);

            // Update map
            navigator.geolocation.getCurrentPosition(user_pos => {
                handleLocationUpdate(user_pos, activity_crd)
            }, err => alert(err));


        })
        .catch(err => alert(err));
}

// SOURCE: https://developer.mozilla.org/en-US/docs/Web/API/Geolocation/getCurrentPosition
function handleLocationUpdate(user_pos, activity_crd) {
    var user_crd = user_pos.coords;
    updateMapAndData(user_crd.latitude, user_crd.longitude, activity_crd.latitude, activity_crd.longitude);
}

function updateActivityInfo(activity_json) {
    // Set fields
    var activity_dateTime = new Date(activity_json["dateTime"]);
    document.getElementById("activity-id").innerHTML = activity_json["id"];
    document.getElementById("activity-title").innerHTML = `Activiteit: ${activity_json["title"]}`;
    document.getElementById("activity-date").innerHTML = `Datum: ${activity_dateTime.toLocaleDateString('nl-BE')}`;
    document.getElementById("activity-time").innerHTML = `Tijd: ${activity_dateTime.toLocaleTimeString('nl-BE')}`;
    document.getElementById("activity-group").innerHTML = `Groep: ${activity_json["group"]}`;
    document.getElementById("activity-description").innerHTML = `${activity_json["description"]}`;

    // Set registered
    // URL: api/register/activity/{id}
    var origin = window.location.origin;
    fetch(`${origin}/api/register/activity/${activity_json["id"]}`, {
        headers: {
            'Accept': 'application/json',
        },
        credentials: 'same-origin'
    })
        .then(response => response.json())
        .then(response => {
            console.log(response);
            document.getElementById("registration").checked = response.registered;
        })
        .catch(err => alert(err));
}

//REST: GET request to get the map with the route 
function updateMapAndData(latS, lonS, latE, lonE) {
    var origin = window.location.origin;
    fetch(`${origin}/api/map/${latS}/${lonS}/${latE}/${lonE}`)
        .then(response => response.json())
        .then(json => {
            document.getElementById("duration").innerHTML = "De routebeschrijving duurt " + json["duration"] + " minuten.";
            document.getElementById("distance").innerHTML = "De activiteit is " + json["distance"] + " kilometer hier vandaan.";
            document.getElementById("map").srcdoc = json["html_map"];
        })
        .catch(err => alert(err));

    return true;
}

//REST: GET weather data
function updateWeatherData(lat, lon) {
    var origin = window.location.origin;
    fetch(`${origin}/api/weather/${lat}/${lon}`)
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

/**************************************************************
*                    Register children                        *
***************************************************************/

function register() {
    var register = document.getElementById("registration").checked;
    if (register) {
        document.getElementById("registration-info").innerHTML = "Je bent ingeschreven voor deze activiteit!";
    }
    else {
        document.getElementById("registration-info").innerHTML = "Je bent nog niet ingeschreven!";
    }

    /*
    * Hieronder moet de registratie naar de database.
    */
    var origin = window.location.origin;
    var activityId = document.getElementById("activity-id").innerText;
    var status = (register) ? 1 : 0;
    console.log(activityId);
    fetch(`${origin}/api/register/activity/${activityId}/${status}`, {
        headers: {
            'Accept': 'application/json',
        },
        credentials: 'same-origin'
    })
        .then(response => response.json())
        .then(response => console.log(response))
        .catch(err => alert(err));
}