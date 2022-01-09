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

//REST: GET request to get the coordinates of the location 
async function getCoordinates(city, street, number) {
    coordinates = [];
    
    url = "https://api.openrouteservice.org/geocode/search?api_key=5b3ce3597851110001cf62484b7bc6e27b5b47fabce3821209f35d73&text="+city+"%20"+street+"%20"+number+"&boundary.country=BEL";
    const response = await fetch(url);

    const json = await response.json();

    coordinates = json["features"][0]["geometry"]["coordinates"];

    return coordinates;
}

/**************************************************************
*                    Save new activities                      *
***************************************************************/

async function saveActivities(){
    var name = document.getElementById("Name").value;
    var date = document.getElementById("Date").value;
    var time = document.getElementById("Time").value;
    var tak  = document.getElementById("tak").value;
    var city = document.getElementById("City").value;
    var street = document.getElementById("Street").value;
    var number = document.getElementById("Number").value;
    var discription = document.getElementById("Discription").value;

    const coordinates = getCoordinates(city, street, number);

    console.log(coordinates);

    /*
    * Hier moet de nieuwe activity opgeslagen worden in de db.
    */

    //...
}

/**************************************************************
*                    Register children                        *
***************************************************************/

function register(){
    var register = document.getElementById("registration").checked;
    if(register){
        document.getElementById("registration-info").innerHTML = "Je bent ingeschreven voor deze activiteit!";
    }
    else {
        document.getElementById("registration-info").innerHTML = "Je bent nog niet ingeschreven!";
    }

    console.log(register);

    /*
    * Hieronder moet de registratie naar de database.
    */

    //...

}

/**************************************************************
*                    Search activities                        *
***************************************************************/

function searchActivities(){
    var date = document.getElementById("searchDate").value;
    var tak  = document.getElementById("searchTak").value;

    console.log(date);
    console.log(tak);

    /*
    * Zoek de activiteit in de db
    */

    //...

    /*
    * Vul de ingeschreven leden in in de tabel
    */

    //...

    /*
    * Geef wat info weer
    */
    document.getElementById("activityName").innerHTML = "Activiteit: Sinterklaas";
    document.getElementById("numberRegistrations").innerHTML = "Aantal leden: 18";
}