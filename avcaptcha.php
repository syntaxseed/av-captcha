<?php
// AVCaptcha - Author: Sherri Wheeler (syntaxseed.com). License: MIT.
session_start();

// ******* Configuration *********
$NumChars  = 6;  // Number of characters in captcha.
$FontSize = 16;
$LineThickness = 1; // Thickness of the random lines.
$NumberOfLines = 4; // Number of random lines to draw.

$NoiseAmount = 200; // Amount of pixel 'noise' to add.

$FontPath = "resources/fonts/Viga-Regular.ttf";
// **************************

$NewImage = imagecreatefromjpeg("resources/img.jpg");

$LineColor = imagecolorallocate($NewImage, 80, 80, 80);             // line color
$TextColor = imagecolorallocate($NewImage, 0, 0, 0);                // Text color black
$BackgroundColor = imagecolorallocate($NewImage, 230, 230, 240);    // Image background color

// Create a random string and save to session:
$RandomStr = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", $NumChars)), 0, $NumChars);
$_SESSION['captchakey'] = $RandomStr;

imagefill($NewImage, 0, 0, $BackgroundColor);
imagesetthickness($NewImage, $LineThickness);

$imgWidth = imagesx($NewImage);
$imgHeight = imagesy($NewImage);

// Draw the random lines:
for ($i = 1; $i <= $NumberOfLines; $i++) {
    $startX = random_int(0, $imgWidth);
    $startY = 0;
    $endX = random_int(0, $imgWidth);
    $endY = $imgHeight;
    imageline($NewImage, $startX, $startY, $endX, $endY, $LineColor);
}

// Write the text onto the image:
imagettftext($NewImage, $FontSize, 0, 10, 18, $TextColor, $FontPath, $RandomStr);

// Draw the noise over the text:
for ($i = 1; $i<=$NoiseAmount; $i++) {
    $SpeckColor = imagecolorallocate($NewImage, random_int(1, 255), random_int(1, 255), random_int(1, 255));
    $SpeckX = random_int(1, $imgWidth);
    $SpeckY = random_int(1, $imgHeight);
    imagesetpixel($NewImage, $SpeckX, $SpeckY, $SpeckColor);
}

// Send headers and output to browser:
header("Content-type: image/jpeg");
imagejpeg($NewImage);
