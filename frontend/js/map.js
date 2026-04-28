const map = L.map("map").setView([40.9732, 14.2077], 12);

L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: "&copy; OpenStreetMap contributors"
}).addTo(map);

fetch("../../backend/routes/api.php?action=books")
    .then(response => response.json())
    .then(books => {
        books.forEach(book => {
            if (book.lat && book.lng) {
                const marker = L.marker([book.lat, book.lng]).addTo(map);

                marker.bindPopup(`
                    <strong>${book.titolo}</strong><br>
                    Autore: ${book.autore}<br>
                    Comune: ${book.comune}<br>
                    Proprietario: ${book.proprietario}<br>
                    <a href="book-detail.html?id=${book.id}">Vedi dettaglio</a>
                `);
            }
        });
    })
    .catch(error => {
        console.error("Errore caricamento mappa:", error);
    });