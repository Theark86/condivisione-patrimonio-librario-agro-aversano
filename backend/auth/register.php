<?php
require_once("../config/db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $comune = trim($_POST["comune"]);

    if (empty($nome) || empty($email) || empty($password) || empty($comune)) {
        die("Tutti i campi sono obbligatori.");
    }

    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() > 0) {
        die("Email già registrata.");
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (nome, email, password, comune) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $email, $passwordHash, $comune]);

    echo "Registrazione completata con successo.";
}
?>