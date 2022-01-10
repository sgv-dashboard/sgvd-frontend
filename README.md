## Activiteiten dashboard voor Scouts & Gidsen Vlaanderen

### Functies:
- Laat leden inloggen via Google of Facebook
- Toon de komende activiteiten met extra info:
    * Titel 
    * Datum
    * Startuur
    * Tak
    * Extra beschrijving
    * Licht of donker bij het einde van de activiteit
    * Route beschrijving naar de activiteit
    * Weerbericht
- Rechten admins:
    * Activiteiten toevoegen
    * Activiteiten verwijderen
    * Leden toegang geven
    * Inschrijvingen per activiteit bekijken

### Opstarten
- `docker compose up` en in de laravel container `php artisan db:seed`
- Ga naar `http://localhost:3000/start`

___

### Info voor ontwikkelaars
- Laravel framework met PHP en Javascript
- Socialite SSO
- MariaDB voor gebruikers
- SOAP database voor activiteiten (C#)
- Docker
- API's
    * Routebeschrijving: https://openrouteservice.org/
    * Weerbericht: http://weerlive.nl/delen.php
    * Contact via e-mail: https://formsubmit.co/

### Contact
Masterstudenten Industriële Wetenschappen Elektronica-ICT (UHasselt)
- lowie.deferme@student.uhasselt.be
- siemen.vandervoort@student.uhasselt.be




___

# Oude readme

### Wat moet er nog gebeuren:
- Inschrijven van kinderen in database (functie is gemaakt in activities.js met switch onchange())
- Ingeschreven kinderen weergeven op de pagina inschrijvingen (functie is gemaakt in activities.js met button onclick())
- Enkele popup messages (zie facebook- en googlecontroller)

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


### Docker

1. Activity container builden/runnen via vs-code task. 
1. Controlleren of de naam van de gegenereerde image `sgvdactivitydb:latest` is. (moet slechts eenmalig normaal) 
1. In [`docker-compose.yml`](docker-compose.yml) zorgen dat het hostPath van (db) volume van activitydb correct is (docker compose structuur is `hostPath:containerPath:ro`)
1. `docker compose up` en alles zou moeten werken
