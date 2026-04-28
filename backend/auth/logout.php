<?php
// ===============================
// AVVIO SESSIONE
// ===============================

// Necessario per poter accedere e distruggere la sessione attiva
session_start();


// ===============================
// DISTRUZIONE SESSIONE
// ===============================

// Elimina tutti i dati della sessione (logout utente)
session_destroy();


// ===============================
// REDIRECT
// ===============================

// Reindirizza l’utente alla homepage dopo il logout
header("Location: ../../frontend/pages/index.html");
exit;
?>