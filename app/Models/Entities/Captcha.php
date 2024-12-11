<?php
session_start();

// Generation d'un code captcha aleatoire en partant d'une liste alphanumerique complete
$permitted_chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
$length = 6;
$captcha_code = substr(str_shuffle($permitted_chars), 0, $length);

setcookie("Test", $captcha_code, time() + (86400 * 2), "/");

// Stockage du code captcha dans la session
$_SESSION['captcha'] = $captcha_code;


// Creation de l'image captcha
$width = 150;
$height = 50;
$image = imagecreate($width, $height);

// Couleurs
$bg_color = imagecolorallocate($image, 255, 255, 255); // Blanc
$text_color = imagecolorallocate($image, 0, 0, 0); // Noir

// Remplissage de l'arriere-plan
imagefilledrectangle($image, 0, 0, $width, $height, $bg_color);

// Ajout du bruit (lignes aléatoires)
for ($i = 0; $i < 5; $i++) {
    $line_color = imagecolorallocate($image, rand(100, 255), rand(100, 255), rand(100, 255));
    imageline($image, 0, rand() % $height, $width, rand() % $height, $line_color);
}

// Ajout du texte du captcha
$font_size = 20;
$font = __DIR__ . '/font/static/OpenSans_Condensed-ExtraBoldItalic.ttf'; // Assurez-vous que le chemin vers la police est correct. Voir remarque a la fin du code
$bbox = imagettfbbox($font_size, 0, $font, $captcha_code);
$x = ($width - ($bbox[2] - $bbox[0])) / 2;
$y = ($height - ($bbox[7] - $bbox[1])) / 2;
$y += $font_size;
imagettftext($image, $font_size, 0, $x, $y, $text_color, $font, $captcha_code);

// Envoie de l'image au navigateur
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);

/** 
 * Police de caractères : Assurez-vous que vous avez une police TrueType (par exemple, arial.ttf) dans un dossier fonts a la racine de votre projet.
 * GD Library : Ce script necessite l'extension GD qui doit etre activer dans votre installation PHP pour manipuler les images.
*/
?>