<?php
// ===============================
// PARAMETRI DI CONNESSIONE DB
// ===============================

// Host del database (locale in ambiente XAMPP)
$host = "localhost";

// Nome del database
$dbname = "patrimonio_librario";

// Username MySQL
$username = "root";

// Password MySQL (vuota in ambiente locale)
$password = "";


// ===============================
// CONNESSIONE PDO
// ===============================

try {
    // Creazione connessione tramite PDO (PHP Data Objects)
    $conn = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $username,
        $password
    );

    // Imposta modalità errore → eccezioni (utile per debug e sicurezza)
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    // Gestione errore connessione
    die("Errore DB: " . $e->getMessage());
}
?>