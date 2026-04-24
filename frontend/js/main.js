fetch("../../backend/routes/api.php?action=books")
    .then(response => response.json())
    .then(data => {

        const container = document.getElementById("books-container");

        data.forEach(book => {
            const div = document.createElement("div");
            div.className = "card";

            div.innerHTML = `
                <h3>${book.titolo}</h3>
                <p><strong>Autore:</strong> ${book.autore}</p>
                <p><strong>Proprietario:</strong> ${book.proprietario}</p>
                <a href="book-detail.html?id=${book.id}">Vedi dettaglio</a>
            `;

            container.appendChild(div);
        });

    })
    .catch(error => console.error(error));