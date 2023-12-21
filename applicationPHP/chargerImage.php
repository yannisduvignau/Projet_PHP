<?php
function loadJpg($imgSource,$dimx,$dimY)
{
    $size = GetImageSize("$imgSource");
    $xSrc = $size[0];
    $ySrc = $size[1];

    $test_x = round(($dimx/$xSrc)*$ySrc);
    $test_y = round(($dimy/$ySrc)*$xSrc);

    $redImg = ImageCreateTrueColor($dimx,$dimy);
    $imageSource = ImageCreateFromJpeg("$imgSource");
    ImageCopyResampled($redImg,$imageSource,$dimx,$dimy,$xSrc,$ySrc);

    ImageDestroy($imageSource);

    return $redImg;
}
 
header('Content-Type: image/jpeg');
 
imagejpeg($img,$_GET['chemImage']);
imagedestroy($img);
?>