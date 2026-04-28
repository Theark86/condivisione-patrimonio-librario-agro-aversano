USE patrimonio_librario;

-- ======================
-- USERS
-- ======================
INSERT INTO users (id, nome, email, password, comune, lat, lng, ruolo, privacy_posizione, created_at) VALUES
(1, 'Marco Rossi', 'marco@example.com', '$2y$10$demo_hash_password', 'Cesa', 40.96540000, 14.23100000, 'utente', 'approssimata', '2026-04-28 12:23:16'),
(2, 'Giulia Esposito', 'giulia@example.com', '$2y$10$demo_hash_password', 'Teverola', 40.99560000, 14.20710000, 'utente', 'approssimata', '2026-04-28 12:23:16'),
(3, 'Nicola Palmiero', 'palmieronicola@gmail.com', '$2y$10$demo_hash_password', 'Lusciano', 40.97090000, 14.19060000, 'utente', 'approssimata', '2026-04-28 12:23:16'),
(4, 'Admin Sistema', 'admin@example.com', '$2y$10$demo_hash_password', 'Aversa', 40.97320000, 14.20770000, 'admin', 'nascosta', '2026-04-28 12:23:16'),
(5, 'Arcangelo Palmiero', 'palmieroarcangelo@gmail.com', '$2y$10$Jb1JwaBd/A2UZOr5/ldRr.DmwrqtRPdHAEgnr0UilCAt8zo8YAj8C', 'Lusciano', 40.97320000, 14.20770000, 'utente', 'precisa', '2026-04-28 14:43:48'),
(9, 'Raffaele Mottola', 'motrraff@esempio.it', '$2y$10$kaZU.hUvuVCLh.iwGwRqo.pTqDmD8UiwrXhQNkGTLeysyKdYLMDO2', 'Carinaro', 40.98160000, 14.21630000, 'utente', 'approssimata', '2026-04-28 16:21:15');

-- ======================
-- BOOKS
-- ======================
INSERT INTO books (id, user_id, titolo, autore, isbn, anno, categoria, descrizione, cover_image, thumbnail_image, created_at) VALUES
(7, 3, 'Gaspare Mollo dei Duchi di Lusciano “Il dolce italico, cantore degli affetti”', 'Nicola Palmiero', '9791221806540', 2023, 'Storia locale', 'L’autore ci offre una panoramica della vita e delle opere di Gaspare Mollo...', 'uploads/covers/cover_69f0b8b02adc73.75945855.jpg', 'uploads/thumbnails/thumb_cover_69f0b8b02adc73.75945855.jpg', '2026-04-28 13:40:00'),
(8, 5, 'Aversa i suoi vescovi e la politica dalle origini a inizio Trecento', 'Luciano Orabona', '9788854878914', 2014, 'Storia locale', 'Numerosi atti notarili...', 'uploads/covers/cover_69f0ce79609ec1.45789530.jpg', 'uploads/thumbnails/thumb_cover_69f0ce79609ec1.45789530.jpg', '2026-04-28 15:12:57'),
(9, 2, 'Aversa Il patrimonio storico, architettonico e artistico. Le chiese – Volume I', 'Claudia Becchimanzi', '9791259949875', 2022, 'Storia locale', 'Il manoscritto esplora...', 'uploads/covers/cover_69f0cf94910a27.94723873.jpg', 'uploads/thumbnails/thumb_cover_69f0cf94910a27.94723873.jpg', '2026-04-28 15:17:40'),
(10, 1, 'Fat People and Things', 'Mattia Paoli', '9791254740729', 2022, 'Arte', 'L’opera è una raccolta...', 'uploads/covers/cover_69f0cff3314265.50858137.jpg', 'uploads/thumbnails/thumb_cover_69f0cff3314265.50858137.jpg', '2026-04-28 15:19:15'),
(11, 9, 'Lo sguardo al futuro Beato Paolo Manna', 'Benito Picascia', '9788825504804', 2017, 'Saggistica', 'Il volume narra la vita...', 'uploads/covers/cover_69f0df2e7aea84.81062795.jpg', 'uploads/thumbnails/thumb_cover_69f0df2e7aea84.81062795.jpg', '2026-04-28 16:24:14');

-- ======================
-- BOOK VIEWS
-- ======================
INSERT INTO book_views (id, book_id, user_id, viewed_at) VALUES
(11, 10, 5, '2026-04-28 15:29:53'),
(12, 10, 5, '2026-04-28 15:29:55'),
(13, 9, 5, '2026-04-28 15:30:00'),
(14, 9, 5, '2026-04-28 15:30:01'),
(15, 9, 5, '2026-04-28 15:30:02'),
(38, 9, 9, '2026-04-28 16:24:33'),
(39, 11, 5, '2026-04-28 16:25:08'),
(40, 10, NULL, '2026-04-28 16:36:47');

-- ======================
-- LOAN REQUESTS
-- ======================
INSERT INTO loan_requests (id, book_id, requester_id, owner_id, messaggio, stato, created_at) VALUES
(4, 7, 1, 1, 'Richiesta di prestito simulata', 'simulata', '2026-04-28 15:01:33'),
(5, 8, 5, 5, 'Richiesta di prestito simulata', 'accettata', '2026-04-28 15:20:32'),
(6, 9, 9, 2, 'Richiesta di prestito simulata', 'simulata', '2026-04-28 16:24:36'),
(7, 11, 5, 9, 'Richiesta di prestito simulata', 'simulata', '2026-04-28 16:25:10'),
(8, 11, 1, 9, 'Richiesta di prestito simulata', 'accettata', '2026-04-28 16:36:59'),
(9, 11, 5, 9, 'Richiesta di prestito simulata', 'rifiutata', '2026-04-28 16:38:54');