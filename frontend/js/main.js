// ===============================
// Gestione Login / Logout
// ===============================

fetch("../../backend/routes/session.php")
    .then(response => response.json())
    .then(data => {
        const authSection = document.getElementById("auth-section");

        if (!authSection) return;

        if (data.logged) {
            authSection.innerHTML = `
                <p>Benvenuto, <strong>${data.user}</strong></p>
                <a href="../../backend/auth/logout.php" class="button-link">Logout</a>
            `;
        } else {
            authSection.innerHTML = `
                <a href="login.html" class="button-link">Login</a>
                <a href="register.html" class="button-link">Registrati</a>
            `;
        }
    })
    .catch(error => {
        console.error("Errore sessione:", error);
    });


// ===============================
// Caricamento libri + ricerca
// ===============================

let allBooks = [];

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
            <img src="${image}" alt="Copertina di ${book.titolo}" class="book-cover">

            <h3>${book.titolo}</h3>

            <p><strong>Autore:</strong> ${book.autore}</p>
            <p><strong>Categoria:</strong> ${book.categoria || "Non specificata"}</p>
            <p><strong>Comune:</strong> ${book.comune || "Non indicato"}</p>
            <p><strong>Proprietario:</strong> ${book.proprietario || "Non indicato"}</p>

            <a href="book-detail.html?id=${book.id}" class="button-link">
                📖 Vedi dettaglio
            </a>
        `;

        container.appendChild(div);
    });
}


// ===============================
// Ricerca testuale + filtro comune
// ===============================

const searchInput = document.getElementById("search-input");
const comuneFilter = document.getElementById("comune-filter");

if (searchInput) {
    searchInput.addEventListener("input", filterBooks);
}

if (comuneFilter) {
    comuneFilter.addEventListener("change", filterBooks);
}

function filterBooks() {
    const searchValue = searchInput.value.toLowerCase();
    const comuneValue = comuneFilter.value;

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