<?php
// ===============================
// INCLUSIONE FILE NECESSARI
// ===============================

// Connessione al database
require_once("../config/db.php");

// Controller libri
require_once("../controllers/bookController.php");

// Imposta risposta JSON
header("Content-Type: application/json");


// ===============================
// LETTURA AZIONE API
// ===============================

// Parametro action passato via GET
$action = $_GET["action"] ?? "";


// ===============================
// ROUTING API (switch)
// ===============================

switch ($action) {

    // ===============================
    // RESTITUISCE TUTTI I LIBRI
    // ===============================
    case "books":
        echo json_encode(BookController::getAllBooks($conn));
        break;


    // ===============================
    // DETTAGLIO SINGOLO LIBRO
    // ===============================
    case "book":
        session_start();

        if (isset($_GET["id"])) {

            $bookId = $_GET["id"];

            // Recupero libro
            $book = BookController::getBookById($conn, $bookId);

            // Se trovato → registra visualizzazione
            if ($book) {

                $userId = $_SESSION["user_id"] ?? null;

                $viewStmt = $conn->prepare("
                    INSERT INTO book_views (book_id, user_id)
                    VALUES (?, ?)
                ");

                $viewStmt->execute([$bookId, $userId]);
            }

            echo json_encode($book);

        } else {
            echo json_encode(["error" => "ID mancante"]);
        }

        break;


    // ===============================
    // STATISTICHE DASHBOARD
    // ===============================
    case "stats":
        require_once("../controllers/statsController.php");

        echo json_encode(StatsController::getStats($conn));
        break;


    // ===============================
    // RICHIESTA PRESTITO
    // ===============================
    case "request_loan":
        session_start();

        $bookId = $_POST["book_id"] ?? null;

        // Utente loggato o demo
        $requesterId = $_SESSION["user_id"] ?? 1;

        if (!$bookId) {
            echo json_encode(["success" => false, "error" => "ID libro mancante"]);
            break;
        }

        // Recupero proprietario libro
        $stmt = $conn->prepare("SELECT user_id FROM books WHERE id = ?");
        $stmt->execute([$bookId]);

        $book = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$book) {
            echo json_encode(["success" => false, "error" => "Libro non trovato"]);
            break;
        }

        $ownerId = $book["user_id"];

        // Inserimento richiesta
        $insert = $conn->prepare("
            INSERT INTO loan_requests (book_id, requester_id, owner_id, messaggio, stato)
            VALUES (?, ?, ?, ?, ?)
        ");

        $insert->execute([
            $bookId,
            $requesterId,
            $ownerId,
            "Richiesta di prestito simulata",
            "simulata"
        ]);

        echo json_encode(["success" => true]);
        break;


    // ===============================
    // RICHIESTE RICEVUTE (OWNER)
    // ===============================
    case "received_requests":
        session_start();

        // Utente proprietario (demo fallback)
        $ownerId = $_SESSION["user_id"] ?? 1;

        $stmt = $conn->prepare("
            SELECT 
                loan_requests.id,
                loan_requests.messaggio,
                loan_requests.stato,
                loan_requests.created_at,
                books.titolo AS titolo_libro,
                users.nome AS richiedente,
                users.email AS email_richiedente
            FROM loan_requests
            JOIN books ON loan_requests.book_id = books.id
            JOIN users ON loan_requests.requester_id = users.id
            WHERE loan_requests.owner_id = ?
            ORDER BY loan_requests.created_at DESC
        ");

        $stmt->execute([$ownerId]);

        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        break;


    // ===============================
    // AGGIORNAMENTO STATO RICHIESTA
    // ===============================
    case "update_request":
        session_start();

        $requestId = $_POST["request_id"] ?? null;
        $status = $_POST["status"] ?? null;

        // Validazione input
        if (!$requestId || !$status) {
            echo json_encode(["success" => false, "error" => "Dati mancanti"]);
            break;
        }

        // Controllo stato valido
        if (!in_array($status, ["accettata", "rifiutata"])) {
            echo json_encode(["success" => false, "error" => "Stato non valido"]);
            break;
        }

        // Update DB
        $stmt = $conn->prepare("
            UPDATE loan_requests 
            SET stato = ?
            WHERE id = ?
        ");

        $stmt->execute([$status, $requestId]);

        echo json_encode(["success" => true]);
        break;


    // ===============================
    // AZIONE NON VALIDA
    // ===============================
    default:
        echo json_encode(["error" => "Azione non valida"]);
}
?>