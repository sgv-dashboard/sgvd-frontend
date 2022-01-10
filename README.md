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
- `docker compose up` en in de laravel container `php artisan migrate:refresh` en `php artisan db:seed`
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
      API documentatie beschikbaar op: https://sgvd-maps.herokuapp.com/documentation
    * Sunset/sunrise
      API documentatie beschikbaar op: 
    * Weerbericht: http://weerlive.nl/delen.php
    * Contact via e-mail: https://formsubmit.co/

### Contact
Masterstudenten Industriële Wetenschappen Elektronica-ICT (UHasselt)
- lowie.deferme@student.uhasselt.be
- siemen.vandervoort@student.uhasselt.be
___

### Docker troubleshooting

1. Activity container builden/runnen via vs-code task. 
1. Controlleren of de naam van de gegenereerde image `sgvdactivitydb:latest` is. (moet slechts eenmalig normaal) 
1. In [`docker-compose.yml`](docker-compose.yml) zorgen dat het hostPath van (db) volume van activitydb correct is (docker compose structuur is `hostPath:containerPath:ro`)
1. `docker compose up` en alles zou moeten werken
