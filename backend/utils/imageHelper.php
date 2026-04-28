<?php

// ===============================
// FUNZIONE UPLOAD IMMAGINE
// ===============================

function uploadCoverImage($file) {

    // Controllo presenza file e assenza errori upload
    if (!isset($file) || $file["error"] !== UPLOAD_ERR_OK) {
        return [null, null];
    }

    // ===============================
    // VALIDAZIONE FORMATO
    // ===============================

    // Tipi MIME consentiti
    $allowedTypes = ["image/jpeg", "image/png", "image/webp"];

    if (!in_array($file["type"], $allowedTypes)) {
        die("Formato immagine non valido. Usa JPG, PNG o WEBP.");
    }


    // ===============================
    // GENERAZIONE NOME FILE UNIVOCO
    // ===============================

    // Estensione file originale
    $extension = pathinfo($file["name"], PATHINFO_EXTENSION);

    // Nome file unico per evitare conflitti
    $fileName = uniqid("cover_", true) . "." . $extension;


    // ===============================
    // PERCORSI SALVATAGGIO
    // ===============================

    // Percorso immagine originale
    $coverPath = "../../uploads/covers/" . $fileName;

    // Percorso thumbnail
    $thumbnailPath = "../../uploads/thumbnails/thumb_" . $fileName;


    // ===============================
    // SALVATAGGIO FILE
    // ===============================

    // Sposta il file caricato nella cartella definitiva
    move_uploaded_file($file["tmp_name"], $coverPath);


    // ===============================
    // CREAZIONE THUMBNAIL
    // ===============================

    // Ridimensiona immagine
    createThumbnail($coverPath, $thumbnailPath, 250, 350);


    // ===============================
    // RITORNO PERCORSI RELATIVI
    // ===============================

    return [
        "uploads/covers/" . $fileName,
        "uploads/thumbnails/thumb_" . $fileName
    ];
}


// ===============================
// FUNZIONE CREAZIONE THUMBNAIL
// ===============================

function createThumbnail($source, $destination, $thumbWidth, $thumbHeight) {

    // Ottiene informazioni immagine
    $info = getimagesize($source);

    if (!$info) {
        return false;
    }

    // Dimensioni originali
    [$width, $height] = $info;

    // Tipo MIME
    $mime = $info["mime"];


    // ===============================
    // CREAZIONE IMMAGINE BASE
    // ===============================

    switch ($mime) {

        case "image/jpeg":
            $image = imagecreatefromjpeg($source);
            break;

        case "image/png":
            $image = imagecreatefrompng($source);
            break;

        case "image/webp":
            $image = imagecreatefromwebp($source);
            break;

        default:
            return false;
    }


    // ===============================
    // CREAZIONE CANVAS THUMBNAIL
    // ===============================

    // Nuova immagine ridimensionata
    $thumb = imagecreatetruecolor($thumbWidth, $thumbHeight);


    // ===============================
    // RIDIMENSIONAMENTO IMMAGINE
    // ===============================

    imagecopyresampled(
        $thumb,     // destinazione
        $image,     // sorgente
        0, 0,       // posizione destinazione
        0, 0,       // posizione sorgente
        $thumbWidth,
        $thumbHeight,
        $width,
        $height
    );


    // ===============================
    // SALVATAGGIO THUMBNAIL
    // ===============================

    // Salva come JPEG con qualità 85
    imagejpeg($thumb, $destination, 85);


    // ===============================
    // LIBERAZIONE MEMORIA
    // ===============================

    imagedestroy($image);
    imagedestroy($thumb);


    return true;
}
?>