<?php
require_once("../config/db.php");

class BookController {

    public static function getAllBooks($conn) {
        $stmt = $conn->prepare("
            SELECT 
                books.*,
                users.nome AS proprietario,
                users.comune,
                users.lat,
                users.lng
            FROM books
            JOIN users ON books.user_id = users.id
            ORDER BY books.created_at DESC
        ");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getBookById($conn, $id) {
        $stmt = $conn->prepare("
            SELECT 
                books.*,
                users.nome AS proprietario,
                users.comune,
                users.lat,
                users.lng
            FROM books
            JOIN users ON books.user_id = users.id
            WHERE books.id = ?
        ");
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>