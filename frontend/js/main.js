// Gestione pulsanti Login / Logout nella home
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
    .catch(error => console.error("Errore sessione:", error));


// Caricamento lista libri
fetch("../../backend/routes/api.php?action=books")
    .then(response => response.json())
    .then(data => {
        const container = document.getElementById("books-container");

        if (!container) return;

        if (!data.length) {
            container.innerHTML = "<p>Nessun libro disponibile.</p>";
            return;
        }

        container.innerHTML = "";

        data.forEach(book => {
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
    })
    .catch(error => {
        console.error("Errore caricamento libri:", error);

        const container = document.getElementById("books-container");
        if (container) {
            container.innerHTML = "<p>Errore nel caricamento dei dati.</p>";
        }
    });