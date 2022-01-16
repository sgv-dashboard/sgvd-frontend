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
    * Weerbericht met extra info
- Rechten admins:
    * Activiteiten toevoegen
    * Activiteiten verwijderen
    * Leden toegang geven
    * Inschrijvingen per activiteit bekijken

### Opstarten
1. Zorg voor de juiste mappenstructuur via het clone van de andere repositories
Volgorde maakt niet uit

├── rootfolder
│   ├── sgvd-activity-db
│   ├── sgvd-frontend
│   ├── sgvd-sunset
│   ├── sgvd-weather

1. Commands
- SOAP service met weer info opstarten met `docker-build: release` task: in Visual Studio Code bij Terminal -> Run Task,  daarna onderstaande commands.
- `docker compose up` en in de laravel container `php artisan migrate:refresh` en `php artisan db:seed`
- Ga naar `http://localhost:3000/start`
- De website zou zichtbaar moeten zijn.

1. Afsluiten
- `ctrl -c` om de containers te stoppen.
___

### Info voor ontwikkelaars
- Laravel framework met PHP en Javascript
- Socialite SSO
- MariaDB voor gebruikers
- Docker

#### Services en API's
- SOAP database voor activiteiten (C#)
- SOAP service voor weerinfo (C#)
- Zelfgemaakt REST service voor routebeschrijving, gebaseerd op:
    * Openrouteservice: https://openrouteservice.org/
    * API documentatie beschikbaar op: https://sgvd-maps.herokuapp.com/documentation
- Zelfgemaakte REST service voor zonsopgang/zonsondergang:
    * API documentatie beschikbaar op: 
- REST service voor het weerbericht:
    * Weerbericht: http://weerlive.nl/delen.php
- POST voor contact:
    * Contact via e-mail: https://formsubmit.co/

### Contact
Masterstudenten Industriële Wetenschappen Elektronica-ICT (UHasselt)
- lowie.deferme@student.uhasselt.be
- siemen.vandervoort@student.uhasselt.be
___

### Docker troubleshooting

1. Activity container builden/runnen via vs-code task. 
1. Controleren of de naam van de gegenereerde image `sgvdactivitydb:latest` is. (moet slechts eenmalig normaal) 
1. In [`docker-compose.yml`](docker-compose.yml) zorgen dat het hostPath van (db) volume van activitydb correct is (docker compose structuur is `hostPath:containerPath:ro`)
1. `docker compose up` en alles zou moeten werken