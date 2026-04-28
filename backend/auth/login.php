<?php
session_start();
require_once("../config/db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email) || empty($password)) {
        die("Inserire email e password.");
    }

    $stmt = $conn->prepare("SELECT id, nome, password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["nome"];
        header("Location: ../../frontend/pages/index.html");
exit;
    } else {
        echo "Credenziali non valide.";
    }
}
?>