<?php

require_once __DIR__ . '/../Models/DAOs/CaptchaDAO.php';
require_once __DIR__ . '/../../database/Database.php';

$db = (new Database())->connect();
$captchaDao = new CaptchaDAO($db);
session_start();


// Definition de l'en-tete pour le retour JSON
header('Content-Type: application/json');

// Fonction qui envoie une reponse JSON
function sendResponse($success, $message, $statusCode = 200) {
    http_response_code($statusCode);
    echo json_encode([
        'success' => $success,
        'message' => $message
    ]);
    exit;
}

// Verification de la reception des données JSON
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

if (!isset($input['captcha'])) {
    sendResponse(false, 'Données captcha manquantes.', 400);
}

// Assainissement de l'entree recue
$captchaSaisi = htmlspecialchars(trim($input['captcha']));

// Verification de l'existence du captcha dans la session
if (!isset($_SESSION['captcha'])) {
    sendResponse(false, 'Captcha non défini côté serveur.', 400);
}

$captchaCorrect = $_SESSION['captcha'];

// Comparaison sécurisee des chaines de caracteres
if (hash_equals($captchaCorrect, $captchaSaisi)) {
    // Si le captcha est correct, vous pouvez reinitialiser le captcha pour une utilisation unique
    unset($_SESSION['captcha']);
    $captchaDao->addCaptcha($captchaCorrect, $captchaSaisi);
    sendResponse(true, 'Captcha correct.');
} else {
    sendResponse(false, 'Captcha incorrect.');
}
?>