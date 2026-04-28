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
	
    default:
        echo json_encode(["error" => "Azione non valida"]);
}
?>