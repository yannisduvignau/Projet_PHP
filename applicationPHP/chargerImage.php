<?php
    if (substr($_GET['chemImage'],-3)==="jpg") {
        header("Content-type: image/jpeg");
        $nomImage = './' . $_GET['chemImage'];
        $tailleImage = getimagesize($nomImage);
        $ancienneL = $tailleImage[0];
        $ancienneH = $tailleImage[1];
        $nouvelleL = $_GET['sizeX'];
        $nouvelleH = $_GET['sizeY'];
        $image = imagecreatefromjpeg($nomImage);
        $vignette = imagecreatetruecolor($nouvelleL, $nouvelleH);
        imageCopyResampled($vignette, $image, 0, 0, 0, 0, $nouvelleL, $nouvelleH, $ancienneL, $ancienneH);
        ImageJpeg($vignette);
        ImageDestroy($image);
        ImageDestroy($vignette);
    }
    else {
        header("Content-type: image/png");
        $nomImage = './' . $_GET['chemImage'];
        $tailleImage = getimagesize($nomImage);
        $ancienneL = $tailleImage[0];
        $ancienneH = $tailleImage[1];
        $nouvelleL = $_GET['sizeX'];
        $nouvelleH = $_GET['sizeY'];
        $image = imagecreatefromjpeg($nomImage);
        $vignette = imagecreatetruecolor($nouvelleL, $nouvelleH);
        imageCopyResampled($vignette, $image, 0, 0, 0, 0, $nouvelleL, $nouvelleH, $ancienneL, $ancienneH);
        ImagePng($vignette);
        ImageDestroy($image);
        ImageDestroy($vignette);
    }
?>