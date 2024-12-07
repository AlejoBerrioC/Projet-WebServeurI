<?php
session_start();
require_once 'Auth.php';
Auth::logout();
header('Location: /Projet-WebServeurI/public/index.php');
exit;
?>