/**************************************************************
*                    Search users                             *
***************************************************************/

async function loadRegistrations(activityId) {
    var origin = window.location.origin;
    fetch(`${origin}/api/registrations/activity/${activityId}`)
        .then(response => response.json())
        .then(userList => updateUserTable(userList))
        .catch(err => alert(err));
}

function updateUserTable(userList) {
    document.getElementById("user-list-table").innerHTML = "";
    userList.forEach(user => {
        // Create elements
        var parent = document.createElement("tr");
        var name = document.createElement("td");
        var email = document.createElement("td");

        // Fill elements
        name.innerText = user.name;
        email.innerText = user.email;

        // Update html
        parent.append(name, email);
        document.getElementById("user-list-table").append(parent);
    });
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
                    loadRegistrations(activity.id);
                    updateActivityInfo(activity);
                };

                // Update html
                parent.append(date, time, title, group);
                document.getElementById("activity-list-table").append(parent);
            });
        })
        .catch(err => console.error(err));
}

function updateActivityInfo(activity) {
    // Set fields
    var activity_dateTime = new Date(activity["dateTime"]);
    document.getElementById("activity-title").innerHTML = `Naam: ${activity["title"]}`;
    document.getElementById("activity-date").innerHTML = `Datum: ${activity_dateTime.toLocaleDateString('nl-BE')}`;
}