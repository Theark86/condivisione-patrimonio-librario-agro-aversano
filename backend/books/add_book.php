<?php
// ===============================
// AVVIO SESSIONE
// ===============================

// Necessaria per recuperare l'utente loggato
session_start();


// ===============================
// INCLUSIONE FILE NECESSARI
// ===============================

// Connessione al database
require_once __DIR__ . "/../config/db.php";

// Helper per gestione immagini (upload + thumbnail)
require_once __DIR__ . "/../utils/imageHelper.php";


// ===============================
// GESTIONE UTENTE
// ===============================

// Se non c'è login attivo, usa utente demo (prototipo)
$userId = $_SESSION["user_id"] ?? 1;


// ===============================
// CONTROLLO METODO REQUEST
// ===============================

// Permette accesso solo tramite POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../../frontend/pages/add-book.html");
    exit;
}


// ===============================
// RECUPERO DATI FORM
// ===============================

// Pulizia input
$titolo = trim($_POST["titolo"] ?? "");
$autore = trim($_POST["autore"] ?? "");
$isbn = trim($_POST["isbn"] ?? "");
$anno = trim($_POST["anno"] ?? "");
$categoria = trim($_POST["categoria"] ?? "");
$descrizione = trim($_POST["descrizione"] ?? "");


// ===============================
// VALIDAZIONE DATI
// ===============================

// Controllo campi obbligatori
if ($titolo === "" || $autore === "") {
    die("Titolo e autore sono obbligatori.");
}


// ===============================
// GESTIONE UPLOAD IMMAGINE
// ===============================

// Funzione helper che salva immagine e genera thumbnail
[$coverImage, $thumbnailImage] = uploadCoverImage($_FILES["cover"] ?? null);


// ===============================
// QUERY INSERIMENTO LIBRO
// ===============================

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

// Preparazione query (sicura)
$stmt = $conn->prepare($sql);


// ===============================
// ESECUZIONE QUERY
// ===============================

$stmt->execute([
    ":user_id" => $userId,
    ":titolo" => $titolo,
    ":autore" => $autore,

    // Se campi vuoti → NULL
    ":isbn" => $isbn ?: null,
    ":anno" => $anno ?: null,
    ":categoria" => $categoria ?: null,
    ":descrizione" => $descrizione ?: null,

    // Percorsi immagini
    ":cover_image" => $coverImage,
    ":thumbnail_image" => $thumbnailImage
]);


// ===============================
// REDIRECT
// ===============================

// Dopo inserimento → homepage
header("Location: ../../frontend/pages/index.html");
exit;