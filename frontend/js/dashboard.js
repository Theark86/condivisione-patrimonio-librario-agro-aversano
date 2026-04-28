fetch("../../backend/routes/api.php?action=stats")
    .then(res => res.json())
    .then(data => {

        document.getElementById("books-count").innerText = data.books;
        document.getElementById("users-count").innerText = data.users;
        document.getElementById("requests-count").innerText = data.requests;

        const labels = data.mostViewed.map(b => b.titolo);
        const values = data.mostViewed.map(b => b.views);

        new Chart(document.getElementById("chart"), {
            type: "bar",
            data: {
                labels: labels,
                datasets: [{
                    label: "Visualizzazioni",
                    data: values
                }]
            }
        });

    });