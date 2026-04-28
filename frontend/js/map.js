// ===============================
// Inizializzazione mappa Leaflet
// ===============================

// Coordinate centrali dell'Agro Aversano.
// La mappa viene caricata centrata sull'area di interesse del progetto.
const map = L.map("map").setView([40.9732, 14.2077], 12);

// Layer cartografico OpenStreetMap.
// Leaflet utilizza queste tile per visualizzare la base geografica.
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: "&copy; OpenStreetMap contributors"
}).addTo(map);


// ===============================
// Caricamento libri geolocalizzati
// ===============================

// Recupera dal backend l'elenco dei libri con relative coordinate del proprietario.
fetch("../../backend/routes/api.php?action=books")
    .then(response => response.json())
    .then(books => {

        // Controllo nel caso non siano presenti libri nel database.
        if (!books.length) {
            console.log("Nessun libro disponibile sulla mappa.");
            return;
        }

        books.forEach(book => {

            // Vengono mostrati sulla mappa solo i libri associati a utenti con coordinate valide.
            if (book.lat && book.lng) {

                // Creazione del marker sulla posizione dell'utente proprietario del libro.
                const marker = L.marker([book.lat, book.lng]).addTo(map);

                // Popup informativo associato al marker.
                // Contiene le informazioni principali del libro e il link alla pagina di dettaglio.
                marker.bindPopup(`
                    <strong>${book.titolo}</strong><br>
                    Autore: ${book.autore}<br>
                    Comune: ${book.comune || "Non indicato"}<br>
                    Proprietario: ${book.proprietario || "Non indicato"}<br>
                    <a href="book-detail.html?id=${book.id}">Vedi dettaglio</a>
                `);
            }
        });
    })
    .catch(error => {
        // Gestione di eventuali errori nel caricamento dei dati dal backend.
        console.error("Errore caricamento mappa:", error);
    });