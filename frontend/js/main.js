fetch("../../backend/routes/api.php?action=books")
    .then(response => response.json())
    .then(data => {
        const container = document.getElementById("books-container");

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
                <p><strong>Proprietario:</strong> ${book.proprietario}</p>
                <a href="book-detail.html?id=${book.id}" class="button-link">Vedi dettaglio</a>
            `;

            container.appendChild(div);
        });
    })
    .catch(error => console.error(error));