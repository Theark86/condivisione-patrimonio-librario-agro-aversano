<?php
require_once("../config/db.php");
require_once("../controllers/bookController.php");

header("Content-Type: application/json");

$action = $_GET["action"] ?? "";

switch ($action) {

    case "books":
        echo json_encode(BookController::getAllBooks($conn));
        break;

    case "book":
        if (isset($_GET["id"])) {
            echo json_encode(BookController::getBookById($conn, $_GET["id"]));
        } else {
            echo json_encode(["error" => "ID mancante"]);
        }
        break;

case "stats":
    require_once("../controllers/statsController.php");
    echo json_encode(StatsController::getStats($conn));
    break;
	
	
case "request_loan":
    session_start();

    $bookId = $_POST["book_id"] ?? null;
    $requesterId = $_SESSION["user_id"] ?? 1;

    if (!$bookId) {
        echo json_encode(["success" => false, "error" => "ID libro mancante"]);
        break;
    }

    $stmt = $conn->prepare("SELECT user_id FROM books WHERE id = ?");
    $stmt->execute([$bookId]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$book) {
        echo json_encode(["success" => false, "error" => "Libro non trovato"]);
        break;
    }

    $ownerId = $book["user_id"];

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
	
case "received_requests":
    session_start();

    // Per il prototipo, se non c'è login attivo usiamo l'utente 1.
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
	
case "update_request":
    session_start();

    $requestId = $_POST["request_id"] ?? null;
    $status = $_POST["status"] ?? null;

    if (!$requestId || !$status) {
        echo json_encode(["success" => false, "error" => "Dati mancanti"]);
        break;
    }

    if (!in_array($status, ["accettata", "rifiutata"])) {
        echo json_encode(["success" => false, "error" => "Stato non valido"]);
        break;
    }

    $stmt = $conn->prepare("
        UPDATE loan_requests 
        SET stato = ?
        WHERE id = ?
    ");

    $stmt->execute([$status, $requestId]);

    echo json_encode(["success" => true]);
    break;	
	
    default:
        echo json_encode(["error" => "Azione non valida"]);
}
?>