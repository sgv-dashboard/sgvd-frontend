//REST: GET request to get the coordinates of the location 
async function getCoordinates(city, street, number) {
    coordinates = [];

    url = "https://api.openrouteservice.org/geocode/search?api_key=5b3ce3597851110001cf62484b7bc6e27b5b47fabce3821209f35d73&text=" + city + "%20" + street + "%20" + number + "&boundary.country=BEL";
    const response = await fetch(url);

    const json = await response.json();

    coordinates = json["features"][0]["geometry"]["coordinates"];

    return coordinates;
}

/**************************************************************
*                    Save new activities                      *
***************************************************************/

async function saveActivities() {
    const city = document.getElementById("City").value;
    const street = document.getElementById("Street").value;
    const number = document.getElementById("Number").value;
    const coordinates = await getCoordinates(city, street, number);
    //51.026940N, 5.237410E
    const coordinate_str = `${coordinates[1]}N, ${coordinates[0]}E`.toString();
    console.log(coordinate_str);

    const date = document.getElementById("date").value;
    const time = document.getElementById("time").value;
    const dateTime = date + 'T' + time + ":00";
    console.log(dateTime);

    const activity = {
        title: document.getElementById("title").value,
        dateTime: dateTime,
        group: document.getElementById("tak").value.toLowerCase(),
        description: document.getElementById("Discription").value,
        location: coordinate_str,
    }


    // Post new activity to /api/activity
    const origin = window.location.origin;
    fetch(`${origin}/api/activity`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(activity)
    })
        .then(alert("Activiteit opgeslagen"))
        .then(loadActivityList())
        .catch(err => alert(err));
}

/**************************************************************
*                        Activity list                        *
***************************************************************/
window.onload = loadActivityList();


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
            document.getElementById("activity-list-table").innerHTML = "";
            activityList.forEach(activity => {
                // Create html elements
                var parent = document.createElement("tr");
                var date = document.createElement("td");
                var time = document.createElement("td");
                var title = document.createElement("td");
                var group = document.createElement("td");

                // Fill elements
                date.innerText = (new Date(activity.dateTime)).toLocaleDateString('nl-BE');
                time.innerText = (new Date(activity.dateTime)).toLocaleTimeString('nl-BE');
                title.innerText = activity.title;
                group.innerText = activity.group;

                // Set onclick to load activity
                parent.onclick = function () {
                    if (confirm(`Zeker dat je ${activity.title} wil verwijderen?`))
                        deleteActivity(activity);
                };

                // Update html
                parent.append(date, time, title, group);
                document.getElementById("activity-list-table").append(parent);
            });
        })
        .catch(err => console.error(err));
}

async function deleteActivity(activity) {
    var origin = window.location.origin;
    fetch(`${origin}/api/activity/${activity.id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(activity)
    })
        .then(alert("Activiteit verwijderd"))
        .then(loadActivityList())
        .catch(err => alert(err));
}