### Nieuwe functies:
- Layout van de verschillende pagina's
- Knoppen met routes naar de controller en view
- Layout van de activiteiten pagina
- Implementatie van routebeschrijving via Heroku
- Implementatie van het weerbericht
- Contact pagina 

### Gebruikte websites:
- Routebeschrijving: https://openrouteservice.org/
- Weerbericht: http://weerlive.nl/delen.php
- Contact e-mail: https://formsubmit.co/

### Testen:
- docker compose up
- localhost:3000/start
- Je zou onderstaand resultaat moeten hebben:
![Alt text](Readme_images/Dashboard.JPG?raw=true "Dashboard")
- Bij activiteiten zou je onderstaand resultaat moeten hebben:
![Alt text](Readme_images/Activiteiten.JPG?raw=true "Activiteiten")

### Troubleshooting:
- In case of a "TypeError: Failed to fetch"-error, the access to fetch data has been blocked by CORS policy because there is no "Access-Control-Allow-Origin" header present on the requested resource. Install the Chrome App "Allow CORS" https://chrome.google.com/webstore/detail/allow-cors-access-control/lhobafahddgcelffkeicbaginigeejlf. After reloading the page, the fetch works again.
