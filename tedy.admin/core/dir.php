<?php

$dir = explode("/", $_GET['dir']);

$dir1 = $dir[1];
$dir2 = $dir[2];
$dir3 = $dir[3];
$dir4 = $dir[4];
$dir5 = $dir[5];
$dir6 = $dir[6];
$dir7 = $dir[7];

if(!empty($dir1)){$currentDir .= "/$dir1";}
if(!empty($dir2)){$currentDir .= "/$dir2";}
if(!empty($dir3)){$currentDir .= "/$dir3";}
if(!empty($dir4)){$currentDir .= "/$dir4";}
if(!empty($dir5)){$currentDir .= "/$dir5";}

?>