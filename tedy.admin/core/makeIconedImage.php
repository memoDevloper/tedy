<?php 
$stamp = imagecreatefrompng('images/logo-watermark.png');

$ext = pathinfo($photo,PATHINFO_EXTENSION);

$photo = "files/$dir2/$dir3/$dir4/$dir5/$dir6";
$stamp = imagecreatefrompng('images/logo-watermark.png');
if($ext == "png" || $ext == "PNG"){
    $im = imagecreatefrompng($photo);
}elseif($ext == "jpg" || $ext == "jpeg" || $ext == "JPG" || $ext == "JPEG"){
    $im = imagecreatefromjpeg($photo);
}elseif($ext == "gif" || $ext == "GIF"){
    $im = imagecreatefromgif($photo);
}

// Set the margins for the stamp and get the height/width of the stamp image
$marge_right = 10;
$marge_bottom = 10;
$sx = imagesx($stamp);
$sy = imagesy($stamp);

// Copy the stamp image onto our photo using the margin offsets and the photo 
// width to calculate positioning of the stamp. 
imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

// Output and free memory

$dir = 'files/l/';

if(!file_exists($dir)){mkdir($dir);fopen($dir . '/index.html', 'w');}
if(!file_exists($dir . $ext)){mkdir($dir . $ext);fopen($dir . $ext . '/index.html', 'w');}
if(!file_exists($dir . $ext . '/' . $dir3)){mkdir($dir . $ext . '/' . $dir3);fopen($dir . $ext . '/' . $dir3 . '/index.html', 'w');}
if(!file_exists($dir . $ext . '/' . $dir3 . '/' . $dir4)){mkdir($dir . $ext . '/' . $dir3 . '/' . $dir4);fopen($dir . $ext . '/' . $dir3 . '/' . $dir4 . '/index.html', 'w');}
if(!file_exists($dir . $ext . '/' . $dir3 . '/' . $dir4 . '/' . $dir5)){mkdir($dir . $ext . '/' . $dir3 . '/' . $dir4 . '/' . $dir5);fopen($dir . $ext . '/' . $dir3 . '/' . $dir4 . '/' . $dir5 . '/index.html', 'w');}

if($ext == "png" || $ext == "PNG"){
    header('Content-Type: image/png');
    imagepng($im, $photo);
    imagepng($im);
}elseif($ext == "jpg" || $ext == "jpeg" || $ext == "JPG" || $ext == "JPEG"){
    header('Content-Type: image/jpg');
    mkdir('files2');
    imagejpeg($im, $photo);
    imagejpeg($im);
}elseif($ext == "gif" || $ext == "GIF"){
    header('Content-Type: image/gif');
    imagegif($im, $photo);
    imagegif($im);
}
imagedestroy($im);