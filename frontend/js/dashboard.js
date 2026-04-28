// ===============================
// Caricamento dati dashboard
// ===============================

// Richiesta al backend per ottenere le statistiche
fetch("../../backend/routes/api.php?action=stats")
    .then(res => res.json())
    .then(data => {

        // ===============================
        // Aggiornamento contatori numerici
        // ===============================

        // Numero totale libri
        document.getElementById("books-count").innerText = data.books;

        // Numero totale utenti registrati
        document.getElementById("users-count").innerText = data.users;

        // Numero totale richieste di prestito
        document.getElementById("requests-count").innerText = data.requests;


        // ===============================
        // Preparazione dati per il grafico
        // ===============================

        // Estrae i titoli dei libri più visualizzati (asse X)
        const labels = data.mostViewed.map(b => b.titolo);

        // Estrae il numero di visualizzazioni (asse Y)
        const values = data.mostViewed.map(b => b.views);


        // ===============================
        // Creazione grafico con Chart.js
        // ===============================

        new Chart(document.getElementById("chart"), {
            type: "bar", // Grafico a barre

            data: {
                labels: labels, // Titoli libri
                datasets: [{
                    label: "Visualizzazioni", // Nome dataset
                    data: values // Valori numerici
                }]
            }
        });

    })
    .catch(err => {
        // Gestione errore nel caso l'API non risponda
        console.error("Errore caricamento statistiche:", err);
    });