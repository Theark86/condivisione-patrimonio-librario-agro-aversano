<?php
session_start();

require_once("../config/db.php");
require_once("../utils/imageHelper.php");

/*
  Per il prototipo, se non c'è login attivo,
  usiamo l'utente 1 come proprietario demo.
*/
$userId = $_SESSION["user_id"] ?? 1;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titolo = trim($_POST["titolo"]);
    $autore = trim($_POST["autore"]);
    $anno = trim($_POST["anno"]);
    $categoria = trim($_POST["categoria"]);
    $descrizione = trim($_POST["descrizione"]);

    if (empty($titolo) || empty($autore)) {
        die("Titolo e autore sono obbligatori.");
    }

    [$coverImage, $thumbnailImage] = uploadCoverImage($_FILES["cover"] ?? null);

    $stmt = $conn->prepare("
        INSERT INTO books 
        (user_id, titolo, autore, anno, categoria, descrizione, cover_image, thumbnail_image)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $userId,
        $titolo,
        $autore,
        $anno,
        $categoria,
        $descrizione,
        $coverImage,
        $thumbnailImage
    ]);

    header("Location: ../../frontend/pages/index.html");
    exit;
}
?>