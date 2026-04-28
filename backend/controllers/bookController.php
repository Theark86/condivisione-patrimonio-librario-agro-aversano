<?php
// ===============================
// CONNESSIONE DATABASE
// ===============================

// Include il file di connessione al database
require_once("../config/db.php");


// ===============================
// CONTROLLER LIBRI
// ===============================

// Classe che gestisce le operazioni sui libri
class BookController {

    // ===============================
    // RECUPERO TUTTI I LIBRI
    // ===============================

    public static function getAllBooks($conn) {

        // Query che unisce libri e utenti (JOIN)
        $stmt = $conn->prepare("
            SELECT 
                books.*,

                -- Nome proprietario del libro
                users.nome AS proprietario,

                -- Informazioni geografiche utente
                users.comune,
                users.lat,
                users.lng

            FROM books

            -- Join per collegare ogni libro al suo proprietario
            JOIN users ON books.user_id = users.id

            -- Ordinamento: più recenti prima
            ORDER BY books.created_at DESC
        ");

        // Esecuzione query
        $stmt->execute();

        // Restituisce tutti i risultati come array associativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ===============================
    // RECUPERO LIBRO PER ID
    // ===============================

    public static function getBookById($conn, $id) {

        // Query per recuperare un singolo libro
        $stmt = $conn->prepare("
            SELECT 
                books.*,

                -- Nome proprietario
                users.nome AS proprietario,

                -- Dati geografici
                users.comune,
                users.lat,
                users.lng

            FROM books

            -- Join con utenti
            JOIN users ON books.user_id = users.id

            -- Filtro per ID libro
            WHERE books.id = ?
        ");

        // Esecuzione con parametro ID
        $stmt->execute([$id]);

        // Restituisce un solo record
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>