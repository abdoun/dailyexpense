<?php 
$im = imagecreatetruecolor(160, 80);
$white = ImageColorAllocate($im, 255, 255, 255); 
$grey = ImageColorAllocate($im, 38, 90, 136);
$black = imagecolorallocate($im, 0, 0, 0);

ImageFill($im, 0, 0, $grey);
//ImageString($im, 7, 80, 10, $_SESSION[new_string], $white);
imagettftext($im,35,10,25,70,$black,'fonts/verdana.ttf',$new_string);
imagettftext($im,35,10,20,65,$white,'fonts/verdana.ttf',$new_string);
header('Content-type: image/png');
imagepng($im);
imagedestroy($im);
?>