-- Creazione database
CREATE DATABASE IF NOT EXISTS patrimonio_librario;
USE patrimonio_librario;

-- ======================
-- TABELLA USERS
-- ======================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    comune VARCHAR(100) NOT NULL,
    lat DECIMAL(10,8) DEFAULT NULL,
    lng DECIMAL(11,8) DEFAULT NULL,
    ruolo ENUM('utente','admin') DEFAULT 'utente',
    privacy_posizione ENUM('precisa','approssimata','nascosta') DEFAULT 'approssimata',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ======================
-- TABELLA BOOKS
-- ======================
CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    titolo VARCHAR(255) NOT NULL,
    autore VARCHAR(255) NOT NULL,
    isbn VARCHAR(20) DEFAULT NULL,
    anno INT DEFAULT NULL,
    categoria VARCHAR(100) DEFAULT NULL,
    descrizione TEXT DEFAULT NULL,
    cover_image VARCHAR(255) DEFAULT NULL,
    thumbnail_image VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- ======================
-- TABELLA BOOK_VIEWS
-- ======================
CREATE TABLE book_views (
    id INT AUTO_INCREMENT PRIMARY KEY,
    book_id INT NOT NULL,
    user_id INT DEFAULT NULL,
    viewed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- ======================
-- TABELLA LOAN REQUESTS
-- ======================
CREATE TABLE loan_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    book_id INT NOT NULL,
    requester_id INT NOT NULL,
    owner_id INT NOT NULL,
    messaggio TEXT,
    stato ENUM('inviata','accettata','rifiutata','simulata') DEFAULT 'simulata',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE,
    FOREIGN KEY (requester_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (owner_id) REFERENCES users(id) ON DELETE CASCADE
);