<?php
// ===============================
// AVVIO SESSIONE
// ===============================

// Permette di salvare dati utente tra le pagine (login)
session_start();

// Connessione al database
require_once("../config/db.php");


// ===============================
// CONTROLLO RICHIESTA POST
// ===============================

// Verifica che il form sia stato inviato tramite POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Recupero e pulizia dati inseriti
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Controllo campi obbligatori
    if (empty($email) || empty($password)) {
        die("Inserire email e password.");
    }


    // ===============================
    // QUERY DATABASE
    // ===============================

    // Preparazione query sicura (prepared statement)
    $stmt = $conn->prepare("SELECT id, nome, password FROM users WHERE email = ?");

    // Esecuzione query con parametro email
    $stmt->execute([$email]);

    // Recupero dati utente
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    // ===============================
    // VERIFICA CREDENZIALI
    // ===============================

    // Controlla se utente esiste e password è corretta
    if ($user && password_verify($password, $user["password"])) {

        // Salvataggio dati utente in sessione
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["nome"];

        // Redirect alla homepage dopo login
        header("Location: ../../frontend/pages/index.html");
        exit;

    } else {

        // Messaggio errore login
        echo "Credenziali non valide.";
    }
}
?>