<?php
// ===============================
// AVVIO SESSIONE
// ===============================

// Necessario per accedere ai dati della sessione utente
session_start();


// ===============================
// HEADER RISPOSTA JSON
// ===============================

// Imposta il tipo di risposta in formato JSON
header("Content-Type: application/json");


// ===============================
// VERIFICA SESSIONE UTENTE
// ===============================

// Controlla se esiste una sessione attiva (utente loggato)
if (isset($_SESSION["user_id"])) {

    // Utente autenticato → restituisce stato e nome
    echo json_encode([
        "logged" => true,
        "user" => $_SESSION["user_name"]
    ]);

} else {

    // Nessuna sessione → utente non autenticato
    echo json_encode([
        "logged" => false
    ]);
}
?>