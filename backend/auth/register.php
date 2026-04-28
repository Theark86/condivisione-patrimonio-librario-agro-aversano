<?php
// ===============================
// CONNESSIONE DATABASE
// ===============================

// Include il file di connessione al database
require_once("../config/db.php");


// ===============================
// CONTROLLO RICHIESTA POST
// ===============================

// Verifica che il form sia stato inviato tramite POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // ===============================
    // RECUPERO DATI DAL FORM
    // ===============================

    // Pulizia dati input
    $nome = trim($_POST["nome"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");
    $comune = trim($_POST["comune"] ?? "");

    // Coordinate geografiche (possono essere null)
    $lat = $_POST["latitudine"] ?? null;
    $lng = $_POST["longitudine"] ?? null;

    // Se vuoti, vengono impostati a null
    $lat = $lat !== "" ? $lat : null;
    $lng = $lng !== "" ? $lng : null;


    // ===============================
    // VALIDAZIONE DATI
    // ===============================

    // Controllo campi obbligatori
    if (empty($nome) || empty($email) || empty($password) || empty($comune)) {
        die("Tutti i campi sono obbligatori.");
    }


    // ===============================
    // CONTROLLO EMAIL DUPLICATA
    // ===============================

    // Verifica se l'email è già presente nel database
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() > 0) {
        die("Email già registrata.");
    }


    // ===============================
    // HASH PASSWORD
    // ===============================

    // Crittografia della password per sicurezza
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);


    // ===============================
    // INSERIMENTO UTENTE
    // ===============================

    // Query di inserimento nel database
    $stmt = $conn->prepare("
        INSERT INTO users 
        (nome, email, password, comune, lat, lng) 
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    // Esecuzione query con i dati inseriti
    $stmt->execute([
        $nome,
        $email,
        $passwordHash,
        $comune,
        $lat,
        $lng
    ]);


    // ===============================
    // REDIRECT
    // ===============================

    // Dopo la registrazione, reindirizza alla pagina login
    header("Location: ../../frontend/pages/login.html");
    exit;
}
?>