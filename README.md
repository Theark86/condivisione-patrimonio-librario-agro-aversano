# Patrimonio Librario Agro Aversano

Applicazione web per la condivisione e geolocalizzazione di collezioni librarie private.

## Obiettivo
Consentire agli utenti di:
- pubblicare i propri libri
- visualizzarli su mappa
- cercare contenuti nelle vicinanze
- simulare richieste di prestito

## Tecnologie utilizzate
- HTML, CSS, JavaScript
- PHP
- MySQL
- Leaflet.js (mappe)
- Chart.js (statistiche)

## Struttura del progetto
- `/frontend` → interfaccia utente
- `/backend` → logica applicativa
- `/database` → script SQL
- `/docs` → documentazione

## Architettura

L'applicazione segue un'architettura client-server:

- Frontend: gestione interfaccia utente
- Backend: gestione logica applicativa e API
- Database: memorizzazione dati utenti e libri

## Avvio del progetto
1. Clonare la repository
2. Importare il database (`database/create_tables.sql`)
3. Configurare la connessione in `backend/config/db.php`
4. Avviare il server locale (XAMPP o simili)

## Funzionalità principali
- Registrazione e login
- Inserimento libri
- Upload copertine
- Ricerca testuale e geografica
- Visualizzazione su mappa
- Dashboard statistiche

## Privacy
- Gestione dati utente
- Geolocalizzazione controllata
- Password cifrate

## API principali

- `api.php?action=books` → lista libri
- `api.php?action=book&id=1` → dettaglio libro

## Anteprima

### Home
![Home](docs/mockup/home.png)

### Mappa
![Mappa](docs/mockup/mappa.png)

### Dettaglio libro
![Dettaglio](docs/mockup/dettaglio-libro.png)