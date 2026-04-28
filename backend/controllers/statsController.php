<?php
require_once("../config/db.php");

class StatsController {

    public static function getStats($conn) {

        $totalBooks = $conn->query("SELECT COUNT(*) FROM books")->fetchColumn();

        $totalUsers = $conn->query("SELECT COUNT(*) FROM users")->fetchColumn();

        $totalRequests = $conn->query("SELECT COUNT(*) FROM loan_requests")->fetchColumn();

        $mostViewed = $conn->query("
            SELECT books.titolo, COUNT(book_views.id) as views
            FROM book_views
            JOIN books ON book_views.book_id = books.id
            GROUP BY books.id
            ORDER BY views DESC
            LIMIT 5
        ")->fetchAll(PDO::FETCH_ASSOC);

        return [
            "books" => $totalBooks,
            "users" => $totalUsers,
            "requests" => $totalRequests,
            "mostViewed" => $mostViewed
        ];
    }
}
?>