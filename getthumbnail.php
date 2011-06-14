<?php
/*
 * returns a smaller, square version of the image in question.  $_GET['s'] is 
 * the address of the original image while $_GET['w'] is the width (and height 
 * to scale the image down to.  For example:
 * "getthumbnail.php?s=path/to/image.jpg?w=200" would return the image at
 * "path/to/image.jpg" scaled down to 200px square.
 */

//TODO: cache cropped versions of scaled images.

//header('Content-type: image/jpeg');
$image = new Imagick($_GET['s']);
$image->cropThumbnailImage($_GET['w'], $_GET['w']);

echo $image;

?>
