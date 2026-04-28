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
	
    default:
        echo json_encode(["error" => "Azione non valida"]);
}
?>