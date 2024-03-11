<?php 
$response = file_get_contents(API_BASE_URL);
$json = json_decode($response);

// Function to resize an image
function resize_image($image, $w, $h) {
    $img = imagescale(imagecreatefromjpeg($image), $w, $h);
    return $img;
}

// Function to generate random numbers without repeating
function randomNumbersNoRepeat($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}

/**
 * Crops an image into pieces of 384x216
 * Image passed into function must be resized to 1920x1080
 */
function cropImage($image) {
    $desiredWidth = 384;
    $desiredHeight = 216;

    $width = imagesx($image);
    $height = imagesy($image);

    // Calculate how many pieces can be extracted horizontally and vertically
    $horizontalPieces = floor($width / $desiredWidth);
    $verticalPieces = floor($height / $desiredHeight);

    $pieceCount = 0;

    for ($y = 0; $y < $verticalPieces; $y++) {
        for ($x = 0; $x < $horizontalPieces; $x++) {
            $piece = imagecreatetruecolor($desiredWidth, $desiredHeight);

            // Calculate the x and y coordinates for the current piece
            $srcX = $x * $desiredWidth;
            $srcY = $y * $desiredHeight;

            // Copy the part of the image
            imagecopy($piece, $image, 0, 0, $srcX, $srcY, $desiredWidth, $desiredHeight);

            // Save the piece to a file
            $pieceFilename = 'temp/' . $pieceCount++ . '.jpg';
            imagejpeg($piece, $pieceFilename);

            // Free up memory
            imagedestroy($piece);
        }
    }

    // Free up memory
    imagedestroy($image);
}
?>