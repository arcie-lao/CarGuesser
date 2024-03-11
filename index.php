<?php 
include('config.php');
include('includes/inc_header.php');
include('image_functions.php');

// img variable is resized to 1920 x 1080 so its even
$img = resize_image('imgs/' . $json[8]->Image, 1920, 1080);

// This crops images from the $img variable
cropImage($img);

$image_random_nums = randomNumbersNoRepeat(7, 19, 5);

$images = array();

for ($i = 0; $i < 5; $i++) {
    $source_image_path = 'temp/' . $i . '.jpg';
    array_push($images, 'temp/' . $image_random_nums[$i] . '.jpg');
}

// for ($i = 0; $i < 5; $i++) {
    echo '<img src="' . $images[0] . '" width="960" height="540">';
// }

include('includes/inc_footer.php');
?>