// ===============================
// Caricamento libri + ricerca
// ===============================

let allBooks = [];

// Recupero libri da API
fetch("../../backend/routes/api.php?action=books")
    .then(response => response.json())
    .then(data => {
        allBooks = data;
        renderBooks(allBooks);
    })
    .catch(error => {
        console.error(error);
        document.getElementById("books-container").innerHTML =
            "<p>Errore nel caricamento dei dati.</p>";
    });


// ===============================
// Rendering libri
// ===============================
function renderBooks(books) {
    const container = document.getElementById("books-container");
    container.innerHTML = "";

    if (!books.length) {
        container.innerHTML = "<p>Nessun libro trovato.</p>";
        return;
    }

    books.forEach(book => {
        const div = document.createElement("div");
        div.className = "card";

        const image = book.thumbnail_image
            ? `../../${book.thumbnail_image}`
            : "../../assets/images/default-book.png";

        div.innerHTML = `
            <img src="${image}" class="book-cover">

            <h3>${book.titolo}</h3>

            <p><strong>Autore:</strong> ${book.autore}</p>
            <p><strong>Categoria:</strong> ${book.categoria || "Non specificata"}</p>
            <p><strong>Comune:</strong> ${book.comune}</p>

            <a href="book-detail.html?id=${book.id}" class="button-link">
                📖 Vedi dettaglio
            </a>
        `;

        container.appendChild(div);
    });
}


// ===============================
// Ricerca e filtro
// ===============================

// input ricerca
document.getElementById("search-input").addEventListener("input", filterBooks);

// filtro comune
document.getElementById("comune-filter").addEventListener("change", filterBooks);

function filterBooks() {
    const searchValue = document.getElementById("search-input").value.toLowerCase();
    const comuneValue = document.getElementById("comune-filter").value;

    const filtered = allBooks.filter(book => {

        const matchesSearch =
            book.titolo.toLowerCase().includes(searchValue) ||
            book.autore.toLowerCase().includes(searchValue) ||
            (book.categoria || "").toLowerCase().includes(searchValue);

        const matchesComune =
            !comuneValue || book.comune === comuneValue;

        return matchesSearch && matchesComune;
    });

    renderBooks(filtered);
}