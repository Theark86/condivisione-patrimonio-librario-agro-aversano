<?php
session_start();
require_once("../config/db.php");

if (!isset($_SESSION["user_id"])) {
    die("Accesso non autorizzato.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titolo = trim($_POST["titolo"]);
    $autore = trim($_POST["autore"]);
    $anno = trim($_POST["anno"]);
    $categoria = trim($_POST["categoria"]);
    $descrizione = trim($_POST["descrizione"]);
    $userId = $_SESSION["user_id"];

    if (empty($titolo) || empty($autore) || empty($anno) || empty($categoria)) {
        die("Compila tutti i campi obbligatori.");
    }

    $stmt = $conn->prepare("
        INSERT INTO books (user_id, titolo, autore, anno, categoria, descrizione)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([$userId, $titolo, $autore, $anno, $categoria, $descrizione]);

    echo "Libro inserito con successo.";
}
?>