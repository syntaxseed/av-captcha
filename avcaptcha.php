<?php
session_start();

// ******* Configuration *********
//$imgWidth = 80;
//$imgHeight =25;

//$NewImage = imagecreatetruecolor($imgWidth, $imgHeight); // Create the actual image object. This is actually not a setting.
$NewImage =imagecreatefromjpeg("resources/img.jpg");

$LineColor = imagecolorallocate($NewImage, 80, 80, 80);  // line color 
$TextColor = imagecolorallocate($NewImage, 0, 0, 0);  // text color black
$BackgroundColor = imagecolorallocate($NewImage, 230, 230, 240); // Image background color.

$NumChars  = 6;  // Number of characters in captcha.
$FontSize = 16;
$LineThickness = 1; // Thickness of the random lines.
$NumberOfLines = 4; // Number of random lines to draw.

$NoiseAmount = 200; // Amount of pixel 'noise' to add.

$FontPath = "resources/timesbd.ttf";
// **************************

$RandomStr = substr(sha1(microtime()) ,0, $NumChars);   // First 6 digits of hash to generate the random string.
$_SESSION['captchakey'] = $RandomStr;  // carry the data through session

imagefill($NewImage, 0, 0, $BackgroundColor);
imagesetthickness($NewImage, $LineThickness);

$imgWidth = imagesx($NewImage);
$imgHeight = imagesy($NewImage);

// Draw the random lines:
for($i = 1; $i <= $NumberOfLines; $i++){
	$startX = rand(0, $imgWidth);
	$startY = 0;
	$endX = rand(0, $imgWidth);
	$endY = $imgHeight;
	imageline($NewImage, $startX, $startY, $endX, $endY, $LineColor); 	
}

imagettftext($NewImage, $FontSize, 0, 13, 18, $TextColor, $FontPath, $RandomStr);

// Draw the noise over the text:
for($i = 1; $i<=$NoiseAmount; $i++){
	$SpeckColor = imagecolorallocate($NewImage, rand(1,255), rand(1,255), rand(1,255));
	$SpeckX = rand(1, $imgWidth);
	$SpeckY = rand(1, $imgHeight);
	imagesetpixel($NewImage, $SpeckX, $SpeckY, $SpeckColor);
}

//header("Content-type: image/png"); 
//imagepng($NewImage);  //Output image to browser 

header("Content-type: image/jpeg"); 
imagejpeg($NewImage);  //Output image to browser 
?>