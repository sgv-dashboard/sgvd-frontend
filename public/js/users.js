window.onload = loadUsers();

function loadUsers() {
    var origin = window.location.origin;
    fetch(`${origin}/api/admin/users`)
        .then(response => response.json())
        .then(users_json => {

            users_json.forEach(user => {
                // Create html elements
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
                
                // Fill elements
                user_name.innerText = user.name;
                user_email.innerText = user.email;

                // Set onchange to update database
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
                
                // Update html
                parent.append(user_name, user_verified, user_email, user_admin);
                document.getElementById("user-list-table").append(parent);
            });

            return users_json;
        })
        .catch(err => console.error(err));
}
/*
function updateUser(user){
    tekst = "Test Siemen";
    aantal = 132;

    let content = {tekst: tekst, aantal: aantal};
    fetch("http://localhost:88/demoRESTjsonPOST.php", {
        method: "post",
        headers: {"Content-type": "application/json"},
        body: JSON.stringify(content)  
    })
            .then(response => response.json())
            .then(json => json.uitkomst)
            .then(setStatus)
            .catch(err => alert(err));

    document.getElementById("aantal").style.backgroundColor = null;
    return true;
}
*/
function updateUser(user){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    let content = {some: 'siemen'};

    // The actual fetch request
    fetch('/test', {
        method: 'post',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(content)
    })
}