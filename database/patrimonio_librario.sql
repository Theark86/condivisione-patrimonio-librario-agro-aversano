-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 28, 2026 alle 19:35
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `patrimonio_librario`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `autore` varchar(255) NOT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `anno` int(11) DEFAULT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `thumbnail_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `books`
--

INSERT INTO `books` (`id`, `user_id`, `titolo`, `autore`, `isbn`, `anno`, `categoria`, `descrizione`, `cover_image`, `thumbnail_image`, `created_at`) VALUES
(7, 3, 'Gaspare Mollo dei Duchi di Lusciano “Il dolce italico, cantore degli affetti”', 'Nicola Palmiero', '9791221806540', 2023, 'Storia locale', 'L’autore ci offre una panoramica della vita e delle opere di Gaspare Mollo, eccellente Poeta del settecento, tra i più ammirati improvvisatori d’Italia per l’eleganza della sua dizione e la grazia soffusa nei suoi versi alati.\r\nFine ed amabile gentiluomo che dalla natura ebbe il raro dono di essere dotato di una fervida fantasia, di prontezza e somma facilità nel far versi ridondanti di spontanea venustà, così come quelli che produce a tavolino. Doti che gli hanno procacciato gli applausi di tutta la colta Italia e i contrassegni di onore e di stima dalla più parte dei Sovrani della medesima e d’Europa.\r\nInoltre, nell’intento di contribuire a tracciare un percorso identitario “culturale” del proprio Paese, ripercorre i tratti salienti della presenza della Famiglia Mollo in Lusciano, dei suoi rappresentanti e delle successioni ereditarie del Ducato dal seicento ad oggi.', 'uploads/covers/cover_69f0b8b02adc73.75945855.jpg', 'uploads/thumbnails/thumb_cover_69f0b8b02adc73.75945855.jpg', '2026-04-28 13:40:00'),
(8, 5, 'Aversa i suoi vescovi e la politica dalle origini a inizio Trecento', 'Luciano Orabona', '9788854878914', 2014, 'Storia locale', 'Numerosi atti notarili, redatti dai canonici del capitolo cattedrale nella Congregatio fratrum Sancti Pauli, documentano un’assidua frequentazione di rapporti nella protocapitale normanna di Aversa tra la classe dirigente laica e gli ambienti ecclesiastici. Il collegio sacerdotale aversano poggiava sin dal sec. XI su autonome vincolanti strutture gerarchiche e svolse, analogamente ai canonici regolari e la Regula canonicorum di Anselmo da Lucca, un’intensa attività pastorale sul piano della cultura e della socialità, con intenti caritativi e di formazione spirituale di vescovi diocesani. Nei primi duecento cinquant’anni di storia della Diocesi si contano diciotto vescovi tra metà di secolo XI e fine del XIII. Se ne riporta qui l’ordine di successione, sinora apparso un problema di non facile soluzione. I primi vescovi del sec. XI furono nominati, e più di una volta consacrati, dal papa, spesso intervenuto anche successivamente, dopo che per un certo tempo furono i canonici della Congregatio a provvedere alla loro nomina, misurandosi con i detentori del potere politico. Sui chierici della Congregatio aversana fermarono l’attenzione anche i capitoli di altre diocesi. Gentile fu nominato a Venafro e Isernia, Basuino a Catanzaro, Guglielmo a Otranto.', 'uploads/covers/cover_69f0ce79609ec1.45789530.jpg', 'uploads/thumbnails/thumb_cover_69f0ce79609ec1.45789530.jpg', '2026-04-28 15:12:57'),
(9, 2, 'Aversa Il patrimonio storico, architettonico e artistico. Le chiese – Volume I', 'Claudia Becchimanzi', '9791259949875', 2022, 'Storia locale', 'Il manoscritto esplora e analizza il vasto patrimonio storico, artistico e architettonico della città di Aversa (CE) che, fondata nel 1030 da Rainulfo Drengot, è stata la prima contea normanna dell’Italia Meridionale. Grazie ai suoi mille anni di storia, questa “città delle cento chiese” vanta di innumerevoli opere artistiche e architettoniche di rilievo, custodite sia in strutture ecclesiastiche che all’interno dei palazzi nobiliari, che ne riempiono il centro storico e arricchiscono ogni suo angolo, strada o piazza. Il volume, nello specifico, si focalizza sullo studio delle chiese, addentrandosi nell’affascinante ricerca delle origini e delle vicende storiche e analizzandone il patrimonio artistico e architettonico. Lo scopo ultimo è divulgare e supportare la salvaguardia dell’eredità culturale della città normanna.', 'uploads/covers/cover_69f0cf94910a27.94723873.jpg', 'uploads/thumbnails/thumb_cover_69f0cf94910a27.94723873.jpg', '2026-04-28 15:17:40'),
(10, 1, 'Fat People and Things', 'Mattia Paoli', '9791254740729', 2022, 'Arte', 'L’opera è una raccolta di disegni che rappresentano omini ciccioni stilizzati. L’idea è nata durante la prima ondata dell’epidemia di COVID-19 in Italia che ha causato nella popolazione una maggiore sedentarietà e, di conseguenza, un aumento fisico di peso. I personaggi sono disegnati di getto, con pennarelli e matite, nelle più variegate situazioni: su una spiaggia, al supermercato, durante attività di smartworking, ecc. Essi vivono la quotidianità spontaneamente: senza nessun vincolo estetico che li renda più belli o più brutti, efficienti o inutili rispetto ad una società odierna che, in continua evoluzione, propone canoni umani ed etici che soffocano l’individualità di ognuno. I disegni, non volendo in alcun modo richiamare il tema dell’obesità, intendono proporre una visione tranquilla dell’umanità.', 'uploads/covers/cover_69f0cff3314265.50858137.jpg', 'uploads/thumbnails/thumb_cover_69f0cff3314265.50858137.jpg', '2026-04-28 15:19:15'),
(11, 9, 'Lo sguardo al futuro Beato Paolo Manna: testimone e maestro di missionaria spiritualità', 'Benito Picascia', '9788825504804', 2017, 'Saggistica', 'Il volume narra la vita di Padre Paolo Manna, soffermandosi sul suo “fallimento” da missionario, causato da una tubercolosi, e sulla ripresa dell’attività evangelica attraverso la produzione di opere letterarie rivolte al clero. Padre Manna fu sacerdote missionario, apostolo delle genti come san Paolo e si adoperò con tutte le sue capacità per essere conforme all’immagine di Gesù Cristo, onde continuare la Sua Missione per l’avvento del Regno di Dio. Nel 1916 diede vita all’Unione Missionaria del Clero e nel 1924 ottenne la nomina a Superiore Generale presso il Pontificio Istituto Missioni Estere (P.I.M.E.). Il 4 novembre 2001 fu proclamato Beato da Papa Giovanni Paolo II.', 'uploads/covers/cover_69f0df2e7aea84.81062795.jpg', 'uploads/thumbnails/thumb_cover_69f0df2e7aea84.81062795.jpg', '2026-04-28 16:24:14');

-- --------------------------------------------------------

--
-- Struttura della tabella `book_views`
--

CREATE TABLE `book_views` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `viewed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `book_views`
--

INSERT INTO `book_views` (`id`, `book_id`, `user_id`, `viewed_at`) VALUES
(11, 10, 5, '2026-04-28 15:29:53'),
(12, 10, 5, '2026-04-28 15:29:55'),
(13, 9, 5, '2026-04-28 15:30:00'),
(14, 9, 5, '2026-04-28 15:30:01'),
(15, 9, 5, '2026-04-28 15:30:02'),
(16, 9, 5, '2026-04-28 15:30:02'),
(17, 9, 5, '2026-04-28 15:30:03'),
(18, 8, 5, '2026-04-28 15:30:11'),
(19, 8, 5, '2026-04-28 15:30:12'),
(20, 8, 5, '2026-04-28 15:30:14'),
(21, 8, 5, '2026-04-28 15:30:14'),
(22, 8, 5, '2026-04-28 15:30:15'),
(23, 8, 5, '2026-04-28 15:30:15'),
(24, 8, 5, '2026-04-28 15:30:15'),
(25, 8, 5, '2026-04-28 15:30:15'),
(26, 7, 5, '2026-04-28 15:30:23'),
(27, 7, 5, '2026-04-28 15:30:25'),
(28, 7, 5, '2026-04-28 15:30:25'),
(29, 7, 5, '2026-04-28 15:30:25'),
(30, 7, 5, '2026-04-28 15:30:25'),
(31, 7, 5, '2026-04-28 15:30:25'),
(32, 7, 5, '2026-04-28 15:30:26'),
(33, 7, 5, '2026-04-28 15:30:26'),
(34, 7, 5, '2026-04-28 15:30:26'),
(35, 7, 5, '2026-04-28 15:30:26'),
(36, 7, 5, '2026-04-28 15:30:26'),
(37, 7, 5, '2026-04-28 15:30:26'),
(38, 9, 9, '2026-04-28 16:24:33'),
(39, 11, 5, '2026-04-28 16:25:08'),
(40, 10, NULL, '2026-04-28 16:36:47'),
(41, 11, NULL, '2026-04-28 16:36:57'),
(42, 11, 5, '2026-04-28 16:38:53'),
(43, 9, 9, '2026-04-28 16:47:43'),
(44, 10, 9, '2026-04-28 16:47:47');

-- --------------------------------------------------------

--
-- Struttura della tabella `loan_requests`
--

CREATE TABLE `loan_requests` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `requester_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `messaggio` text DEFAULT NULL,
  `stato` enum('inviata','accettata','rifiutata','simulata') DEFAULT 'simulata',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `loan_requests`
--

INSERT INTO `loan_requests` (`id`, `book_id`, `requester_id`, `owner_id`, `messaggio`, `stato`, `created_at`) VALUES
(4, 7, 1, 1, 'Richiesta di prestito simulata', 'simulata', '2026-04-28 15:01:33'),
(5, 8, 5, 5, 'Richiesta di prestito simulata', 'accettata', '2026-04-28 15:20:32'),
(6, 9, 9, 2, 'Richiesta di prestito simulata', 'simulata', '2026-04-28 16:24:36'),
(7, 11, 5, 9, 'Richiesta di prestito simulata', 'simulata', '2026-04-28 16:25:10'),
(8, 11, 1, 9, 'Richiesta di prestito simulata', 'accettata', '2026-04-28 16:36:59'),
(9, 11, 5, 9, 'Richiesta di prestito simulata', 'rifiutata', '2026-04-28 16:38:54');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `comune` varchar(100) NOT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `lng` decimal(11,8) DEFAULT NULL,
  `ruolo` enum('utente','admin') DEFAULT 'utente',
  `privacy_posizione` enum('precisa','approssimata','nascosta') DEFAULT 'approssimata',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `nome`, `email`, `password`, `comune`, `lat`, `lng`, `ruolo`, `privacy_posizione`, `created_at`) VALUES
(1, 'Marco Rossi', 'marco@example.com', '$2y$10$demo_hash_password', 'Cesa', 40.96540000, 14.23100000, 'utente', 'approssimata', '2026-04-28 12:23:16'),
(2, 'Giulia Esposito', 'giulia@example.com', '$2y$10$demo_hash_password', 'Teverola', 40.99560000, 14.20710000, 'utente', 'approssimata', '2026-04-28 12:23:16'),
(3, 'Nicola Palmiero', 'palmieronicola@gmail.com', '$2y$10$demo_hash_password', 'Lusciano', 40.97090000, 14.19060000, 'utente', 'approssimata', '2026-04-28 12:23:16'),
(4, 'Admin Sistema', 'admin@example.com', '$2y$10$demo_hash_password', 'Aversa', 40.97320000, 14.20770000, 'admin', 'nascosta', '2026-04-28 12:23:16'),
(5, 'Arcangelo Palmiero', 'palmieroarcangelo@gmail.com', '$2y$10$Jb1JwaBd/A2UZOr5/ldRr.DmwrqtRPdHAEgnr0UilCAt8zo8YAj8C', 'Lusciano', 40.97320000, 14.20770000, 'utente', 'precisa', '2026-04-28 14:43:48'),
(9, 'Raffaele Mottola', 'motrraff@esempio.it', '$2y$10$kaZU.hUvuVCLh.iwGwRqo.pTqDmD8UiwrXhQNkGTLeysyKdYLMDO2', 'Carinaro', 40.98160000, 14.21630000, 'utente', 'approssimata', '2026-04-28 16:21:15');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indici per le tabelle `book_views`
--
ALTER TABLE `book_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indici per le tabelle `loan_requests`
--
ALTER TABLE `loan_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `requester_id` (`requester_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `book_views`
--
ALTER TABLE `book_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT per la tabella `loan_requests`
--
ALTER TABLE `loan_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `book_views`
--
ALTER TABLE `book_views`
  ADD CONSTRAINT `book_views_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_views_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Limiti per la tabella `loan_requests`
--
ALTER TABLE `loan_requests`
  ADD CONSTRAINT `loan_requests_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `loan_requests_ibfk_2` FOREIGN KEY (`requester_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `loan_requests_ibfk_3` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
