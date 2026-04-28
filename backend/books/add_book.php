<?php
session_start();

require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../utils/imageHelper.php";

// Per il prototipo, se non c'è login attivo, usiamo l'utente 1 come proprietario demo.
$userId = $_SESSION["user_id"] ?? 1;

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../../frontend/pages/add-book.html");
    exit;
}

$titolo = trim($_POST["titolo"] ?? "");
$autore = trim($_POST["autore"] ?? "");
$isbn = trim($_POST["isbn"] ?? "");
$anno = trim($_POST["anno"] ?? "");
$categoria = trim($_POST["categoria"] ?? "");
$descrizione = trim($_POST["descrizione"] ?? "");

if ($titolo === "" || $autore === "") {
    die("Titolo e autore sono obbligatori.");
}

[$coverImage, $thumbnailImage] = uploadCoverImage($_FILES["cover"] ?? null);

$sql = "
    INSERT INTO books (
        user_id,
        titolo,
        autore,
        isbn,
        anno,
        categoria,
        descrizione,
        cover_image,
        thumbnail_image
    ) VALUES (
        :user_id,
        :titolo,
        :autore,
        :isbn,
        :anno,
        :categoria,
        :descrizione,
        :cover_image,
        :thumbnail_image
    )
";

$stmt = $conn->prepare($sql);

$stmt->execute([
    ":user_id" => $userId,
    ":titolo" => $titolo,
    ":autore" => $autore,
    ":isbn" => $isbn ?: null,
    ":anno" => $anno ?: null,
    ":categoria" => $categoria ?: null,
    ":descrizione" => $descrizione ?: null,
    ":cover_image" => $coverImage,
    ":thumbnail_image" => $thumbnailImage
]);

header("Location: ../../frontend/pages/index.html");
exit;