# 📚 Patrimonio Librario Agro Aversano

Applicazione web per la condivisione e la geolocalizzazione di patrimoni librari privati nell’Agro Aversano.

---

## 🎯 Obiettivo

Il progetto consente agli utenti di:

- 📖 Pubblicare libri della propria collezione privata  
- 🗺️ Visualizzare i libri su mappa  
- 🔍 Cercare contenuti nel territorio  
- 🤝 Simulare richieste di prestito  
- 📊 Monitorare statistiche di utilizzo  

---

## ⚙️ Tecnologie utilizzate

### Frontend
- HTML5  
- CSS3  
- JavaScript  
- Leaflet.js (mappe)  
- Chart.js (grafici)

### Backend
- PHP  
- MySQL  
- API REST (`api.php`)

---

## 🧱 Architettura

Architettura **client-server**:

- Frontend → interfaccia utente  
- Backend → API REST PHP  
- Database → MySQL  

---

## 📂 Struttura del progetto

```
patrimonio-librario-agro-aversano/
├── frontend/
├── backend/
├── database/
├── uploads/
├── assets/
└── docs/
```

## 🚀 Funzionalità principali

### 👤 Utenti
- Registrazione con selezione comune di residenza e geolocalizzazione automatica / manuale
- Login / Logout
- Gestione sessione

### 📚 Libri
- Inserimento libri
- Upload copertine e miniature
- Visualizzazione dettagli libro
- Tracciamento visualizzazioni

### 🗺️ Mappa
- Visualizzazione geolocalizzata
- Marker per ogni libro

### 🤝 Prestiti (simulati)
- Richiesta prestito
- Visualizzazione richieste ricevute
- Accettazione / rifiuto richieste

### 📊 Dashboard
- Totale libri
- Totale utenti
- Numero richieste
- Grafico libri più visualizzati

---

## 🔌 API principali

### 📚 Libri

Lista libri  
GET /backend/routes/api.php?action=books  

Dettaglio libro  
GET /backend/routes/api.php?action=book&id={id}  

---

### 🤝 Prestiti

Richiedi prestito  
POST /backend/routes/api.php?action=request_loan  

Parametri:
- book_id  

Richieste ricevute  
GET /backend/routes/api.php?action=received_requests  

Aggiorna richiesta  
POST /backend/routes/api.php?action=update_request  

Parametri:
- request_id  
- status (accettata / rifiutata)  

---

### 📊 Statistiche

Dashboard  
GET /backend/routes/api.php?action=stats  

Restituisce:
- numero libri  
- numero utenti  
- numero richieste  
- libri più visualizzati  

---

## 🧪 Avvio del progetto

1. Clonare il repository:

git clone https://github.com/Theark86/patrimonio-librario-agro-aversano-

2. Copiare il progetto in:

C:\xampp\htdocs\patrimonio-librario-agro-aversano

3. Avviare XAMPP:
- Apache  
- MySQL  

4. Creare database:

patrimonio_librario  

5. Importare il database:

Il database può essere creato importando:

- `database/create_tables.sql` (struttura)
- `database/sample_data.sql` (dati di esempio)

In alternativa è disponibile anche un dump completo:

- `database/patrimonio_librario_dump.sql`

6. Aprire nel browser:

http://localhost/patrimonio-librario-agro-aversano/frontend/pages/index.html  

---

## 🔐 Privacy

- Geolocalizzazione limitata al comune  
- Password cifrate  
- Gestione sessione  

---

## 📌 Note

Il progetto è un **prototipo dimostrativo**.

Possibili sviluppi futuri:
- Sistema notifiche  
- Chat tra utenti  
- Prestiti reali  
- Recensioni  
- Autenticazione avanzata  

---

## 🎓 Autore

Arcangelo Palmiero
---

## ⭐ Stato del progetto

✔ Completato  
✔ Funzionante  
✔ Include frontend, backend e database  
✔ Conforme ai requisiti richiesti  
---

## 📸 Screenshot

### 🏠 Home
![Home](https://raw.githubusercontent.com/Theark86/patrimonio-librario-agro-aversano-/main/assets/images/screenshots/home.png)

### 🔐 Login
![Login](https://raw.githubusercontent.com/Theark86/patrimonio-librario-agro-aversano-/main/assets/images/screenshots/login.png)

### 📝 Registrazione
![Registrazione](https://raw.githubusercontent.com/Theark86/patrimonio-librario-agro-aversano-/main/assets/images/screenshots/registrati.png)

### ➕ Aggiungi libro
![Aggiungi libro](https://raw.githubusercontent.com/Theark86/patrimonio-librario-agro-aversano-/main/assets/images/screenshots/aggiungilibro.png)

### 📖 Dettaglio libro
![Dettaglio libro](https://raw.githubusercontent.com/Theark86/patrimonio-librario-agro-aversano-/main/assets/images/screenshots/dettagliolibro.png)

### 🗺️ Mappa
![Mappa](https://raw.githubusercontent.com/Theark86/patrimonio-librario-agro-aversano-/main/assets/images/screenshots/mappa.png)

### 📍📖 Mappa con dettaglio libro
![Mappa con dettaglio libro](https://raw.githubusercontent.com/Theark86/patrimonio-librario-agro-aversano-/main/assets/images/screenshots/mappacondettagliolibro.png)

### 📊 Dashboard
![Dashboard](https://raw.githubusercontent.com/Theark86/patrimonio-librario-agro-aversano-/main/assets/images/screenshots/dashboard.png)

### 📩 Richieste ricevute
![Richieste](https://raw.githubusercontent.com/Theark86/patrimonio-librario-agro-aversano-/main/assets/images/screenshots/richieste-ricevute.png)