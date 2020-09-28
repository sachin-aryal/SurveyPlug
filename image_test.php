<?php

require_once('wp-config.php');
require_once 'wp-content/plugins/cartapari-survey/util/helper.php';
require_once 'wp-content/plugins/cartapari-survey/util/constant.php';
global $wpdb, $table_name_mapping;

$best_ratings = get_best_rating($wpdb, $table_name_mapping["total_rating"], null);
$total = 0;
foreach ($best_ratings as $best_rating){
    $total += $best_rating->survey_total_rating;
}
$average = $total/sizeof($best_ratings);

// Create an image of given size
$width = 1300;
$height = 450;
$image = imagecreatetruecolor($width, $height);
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);
$font_path = 'arial.ttf';
// Draw the rectangle of green color
imagefilledrectangle($image, 0, 0, $width, $height, $white);
imagerectangle($image, 20, 100, $width-20, 200, $black);
imagettftext($image, 14, 0, 550, 150, $black, $font_path, "Punteggio Generale");
imagettftext($image, 14, 0, 610, 180, $black, $font_path, "$average%");
$index = 1;
foreach ($best_ratings as $best_rating){
    $x1 = 127*($index-1);
    if($index == 1){
        $x1 = 20;
    }else{
        $x1 += 20;
    }
    $x2 = $x1+110;
    if($index == 10){
        $x2 = 1280;
    }
    imagerectangle($image, $x1, 230, $x2, 300, $black);
    imagettftext($image, 14, 0, $x1+9, 270, $black, $font_path, "Section - $index");
    imagettftext($image, 14, 0, $x1+40, 292, $black, $font_path, "$best_rating->survey_total_rating%");
    $index += 1;
}

imagejpeg($image, 'test_image.jpg');
// Output image in png format
header("Content-type: image/jpg");
imagepng($image);

// Free memory
imagedestroy($image);

?>