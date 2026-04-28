USE patrimonio_librario;

INSERT INTO users 
(nome, email, password, comune, lat, lng, ruolo, privacy_posizione)
VALUES
('Marco Rossi', 'marco@example.com', '$2y$10$demo_hash_password', 'Aversa', 40.97320000, 14.20770000, 'utente', 'approssimata'),
('Giulia Esposito', 'giulia@example.com', '$2y$10$demo_hash_password', 'Teverola', 40.99560000, 14.20710000, 'utente', 'approssimata'),
('Antonio Verde', 'antonio@example.com', '$2y$10$demo_hash_password', 'Lusciano', 40.97090000, 14.19060000, 'utente', 'approssimata'),
('Admin Sistema', 'admin@example.com', '$2y$10$demo_hash_password', 'Aversa', 40.97320000, 14.20770000, 'admin', 'nascosta');

INSERT INTO books
(user_id, titolo, autore, anno, categoria, descrizione, cover_image, thumbnail_image)
VALUES
(1, 'Storia di Aversa', 'Autore locale', 1998, 'Storia locale',
 'Volume dedicato alla storia e alla cultura del territorio aversano.',
 NULL, NULL),

(1, 'Racconti campani', 'AA.VV.', 2005, 'Narrativa',
 'Raccolta di racconti ambientati in Campania.',
 NULL, NULL),

(2, 'Letteratura italiana contemporanea', 'Vari autori', 2010, 'Letteratura',
 'Testo utile per lo studio della letteratura italiana moderna e contemporanea.',
 NULL, NULL),

(2, 'Guida alle biblioteche domestiche', 'Maria Bianchi', 2018, 'Cultura digitale',
 'Manuale introduttivo alla catalogazione e gestione di piccole raccolte librarie.',
 NULL, NULL),

(3, 'Manuale di informatica di base', 'Mario Bianchi', 2020, 'Informatica',
 'Testo introduttivo ai concetti fondamentali dell’informatica.',
 NULL, NULL),

(3, 'Introduzione alle reti', 'Luigi Romano', 2019, 'Tecnologia',
 'Libro dedicato ai concetti base delle reti di calcolatori.',
 NULL, NULL);

INSERT INTO loan_requests
(book_id, requester_id, owner_id, messaggio, stato)
VALUES
(1, 2, 1, 'Sarei interessata a consultare questo volume per una ricerca locale.', 'simulata'),
(3, 1, 2, 'Vorrei maggiori informazioni sul libro e sulla possibilità di prestito.', 'simulata'),
(5, 2, 3, 'Mi interessa il testo di informatica per studio personale.', 'simulata');

INSERT INTO book_views
(book_id, user_id)
VALUES
(1, 2),
(1, 3),
(2, 2),
(3, 1),
(3, 3),
(4, 1),
(5, 2),
(5, 1),
(5, 3),
(6, 1);