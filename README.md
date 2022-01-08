### Nieuwe functies:
- Layout van de verschillende pagina's
- Knoppen met routes naar de controller en view
- Layout van de activiteiten pagina
- Implementatie van routebeschrijving via Heroku
- Implementatie van het weerbericht
- Contact pagina
- Facebook feed
- Single Sign On Google + redirections
- Single Sign On Facebook + redirections
- Merge van de activiteiten database
- Toevoeging van Admin en Verified in de database + enkel users met Admin krijgen het tab admin
- Layout van de admin pagina: velden om activiteiten toe te voegen en tabel om rechten van users aan te passen aan de hand van een checkbox
- Velden nieuwe activiteiten uitlezen + api om coordinaten op te vragen van service (werkt nog niet helemaal)

### Wat werkt er niet:
- Docker omgeving
- Api om coordinaten op te vragen van service (werkt nog niet helemaal)
- Admin en Verified enkel toegepast voor Google login, Facebook login moet nog gebeuren

### Gebruikte websites:
- Routebeschrijving: https://openrouteservice.org/
- Weerbericht: http://weerlive.nl/delen.php
- Contact e-mail: https://formsubmit.co/

### Testen:
- php artisan serve (Docker compose up werkt bij mij niet meer)
- localhost:8000/start (localhost:3000/start indien Docker werkt)
- Je zou onderstaand resultaat moeten hebben:
![Alt text](Readme_images/Dashboard.JPG?raw=true "Dashboard")
- Bij activiteiten zou je onderstaand resultaat moeten hebben:
![Alt text](Readme_images/Activiteiten.JPG?raw=true "Activiteiten")

### Troubleshooting:
- In case of a "TypeError: Failed to fetch"-error, the access to fetch data has been blocked by CORS policy because there is no "Access-Control-Allow-Origin" header present on the requested resource. Install the Chrome App "Allow CORS" https://chrome.google.com/webstore/detail/allow-cors-access-control/lhobafahddgcelffkeicbaginigeejlf. After reloading the page, the fetch works again.

    => should be solved by enabling CORS in maps api!

- In case of this error: lcobucci/jwt 4.1.5 requires ext-sodium * -> it is missing from your system. Install or enable PHP's sodium extension.
Search for you php.ini file by executing 'php --init' in your terminal. Go to this file, open it, and add 'extension=php_sodium.dll'.

- Vergeet de xampp niet op te zetten, database zou beschikbaar moeten zijn op localhost:88/phpmyadmin. Indien je een foutmelding krijg dat de database niet gevonden is maak je deze aan: 'sgv-dashboard' en voer je de migraties uit met 'php artisan migrate'.

- Je bent ingelogd als je naam links boven staat. Indien je niet ingelogd geraakt ga je naar de googleController of facebookController en haal je de juiste functie uit comment.

- Vergeet geen 'php artisan migrate' of 'php artisan migrate:refresh' te doen om de nieuwe kolommen in de tabel te krijgen. Waarschijnlijk moet je ook ervoor zorgen dat je jezelf kan toevoegen aan de databank.