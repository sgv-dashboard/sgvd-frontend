window.onload = loadUsers();

/**************************************************************
*                   Load users in admin page                  *
***************************************************************/

function loadUsers() {
    var origin = window.location.origin;
    fetch(`${origin}/api/admin/users`)
        .then(response => response.json())
        .then(users_json => {

            users_json.forEach(user => {
                var parent = document.createElement("tr");
                var user_name = document.createElement("td");
                var user_email = document.createElement("td");

                var user_verified = document.createElement("INPUT");
                user_verified.setAttribute("type", "checkbox");

                var user_admin = document.createElement("INPUT");
                user_admin.setAttribute("type", "checkbox")

                if(parseInt(user.verified)){
                    user_verified.checked = true;
                }
                else {
                    user_verified.checked = false;
                }
                if(parseInt(user.admin)){
                    user_admin.checked = true;
                }
                else {
                    user_admin.checked = false;
                }
                
                user_name.innerText = user.name;
                user_email.innerText = user.email;

                user_admin.onchange = function () {
                    if(user_admin.checked){
                        user.admin = "1";
                        updateUser(user)
                    }
                    else {
                        user.admin = "0";
                        updateUser(user)
                    }
                };

                user_verified.onchange = function () {
                    if(user_verified.checked){
                        user.verified = "1";
                        updateUser(user)
                    }
                    else {
                        user.verified = "0";
                        updateUser(user)
                    }
                };
                
                parent.append(user_name, user_verified, user_email, user_admin);
                document.getElementById("user-list-table").append(parent);
            });

            return users_json;
        })
        .catch(err => console.error(err));
}

/**************************************************************
*                        Update user rights                   *
***************************************************************/

function updateUser(user){
    var origin = window.location.origin;
    var url = toString(origin) + "/updateDb/" + user.id + "/" + user.admin + "/" + user.verified;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(xhttp.responseText);
        }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
}