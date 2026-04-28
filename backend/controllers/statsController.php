<?php
// ===============================
// CONNESSIONE DATABASE
// ===============================

// Include il file di connessione al database
require_once("../config/db.php");


// ===============================
// CONTROLLER STATISTICHE
// ===============================

// Classe che gestisce il recupero delle statistiche
class StatsController {

    // ===============================
    // METODO PRINCIPALE STATISTICHE
    // ===============================

    public static function getStats($conn) {

        // ===============================
        // CONTEGGI TOTALI
        // ===============================

        // Numero totale libri
        $totalBooks = $conn->query("SELECT COUNT(*) FROM books")
                           ->fetchColumn();

        // Numero totale utenti
        $totalUsers = $conn->query("SELECT COUNT(*) FROM users")
                           ->fetchColumn();

        // Numero totale richieste di prestito
        $totalRequests = $conn->query("SELECT COUNT(*) FROM loan_requests")
                             ->fetchColumn();


        // ===============================
        // LIBRI PIÙ VISUALIZZATI
        // ===============================

        // Query per ottenere i libri con più visualizzazioni
        $mostViewed = $conn->query("
            SELECT 
                books.titolo,                     -- Titolo del libro
                COUNT(book_views.id) as views     -- Numero visualizzazioni

            FROM book_views

            -- Join per collegare visualizzazioni ai libri
            JOIN books ON book_views.book_id = books.id

            -- Raggruppa per libro
            GROUP BY books.id

            -- Ordina dal più visto al meno visto
            ORDER BY views DESC

            -- Limita ai primi 5 risultati
            LIMIT 5
        ")->fetchAll(PDO::FETCH_ASSOC);


        // ===============================
        // RISULTATO FINALE
        // ===============================

        // Restituisce un array con tutte le statistiche
        return [
            "books" => $totalBooks,
            "users" => $totalUsers,
            "requests" => $totalRequests,
            "mostViewed" => $mostViewed
        ];
    }
}
?>