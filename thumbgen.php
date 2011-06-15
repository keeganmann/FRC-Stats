<?php

if ($_GET['batchupdate'] == 'robotpics') {
    $imagefolder = 'robopics/';
    $pics = directory($imagefolder, "jpg,JPG,JPEG,jpeg,png,PNG");
    $pics = ditchtn($pics, "220x220_");
    $pics = ditchtn($pics, "100x100_");
    if ($pics[0] != "") {
        foreach ($pics as $p) {
            echo "Crunching " . $p . "<br/>";
            createthumb($imagefolder . $p, $imagefolder . "220x220_" . $p, 220, 220);
        }
        echo "DONE!!<br/>";
    }
}

/*
  Function ditchtn($arr,$thumbname)
  filters out thumbnails
 */

function ditchtn($arr, $thumbname) {
    foreach ($arr as $item) {
        if (!preg_match("/^" . $thumbname . "/", $item)) {
            $tmparr[] = $item;
        }
    }
    return $tmparr;
}

/*
  Function createthumb($name,$filename,$new_w,$new_h)
  creates a resized image
  variables:
  $name		Original filename
  $filename	Filename of the resized image
  $new_w		width of resized image
  $new_h		height of resized image
 */

function createthumb($name, $filename, $new_w, $new_h) {
    $offsety = $offsetx = 0;
    $system = explode(".", $name);
    if (preg_match("/jpg|jpeg|JPG/", $system[1])) {
        $src_img = imagecreatefromjpeg($name);
    }
    if (preg_match("/png|PNG/", $system[1])) {
        $src_img = imagecreatefrompng($name);
    }
    $old_x = imageSX($src_img);
    $old_y = imageSY($src_img);
    if ($old_x > $old_y) {
        $offsetx = ($old_x - $old_y) / 2.0;
        $old_x = $old_y;
    }
    if ($old_x < $old_y) {
        $offsety = ($old_y - $old_x) / 2.0;
        $old_y = $old_x;
    }
    $dst_img = ImageCreateTrueColor($new_w, $new_h);
    imagecopyresampled($dst_img, $src_img, 0, 0, $offsetx, $offsety, $new_w, $new_h, $old_x, $old_y);
    if (preg_match("/png/", $system[1])) {
        imagepng($dst_img, $filename);
    } else {
        imagejpeg($dst_img, $filename);
    }
    imagedestroy($dst_img);
    imagedestroy($src_img);
}

/*
  Function directory($directory,$filters)
  reads the content of $directory, takes the files that apply to $filter
  and returns an array of the filenames.
  You can specify which files to read, for example
  $files = directory(".","jpg,gif");
  gets all jpg and gif files in this directory.
  $files = directory(".","all");
  gets all files.
 */

function directory($dir, $filters) {
    $handle = opendir($dir);
    $files = array();
    if ($filters == "all") {
        while (($file = readdir($handle)) !== false) {
            $files[] = $file;
        }
    }
    if ($filters != "all") {
        $filters = explode(",", $filters);
        while (($file = readdir($handle)) !== false) {
            for ($f = 0; $f < sizeof($filters); $f++):
                $system = explode(".", $file);
                if ($system[1] == $filters[$f]) {
                    $files[] = $file;
                }
            endfor;
        }
    }
    closedir($handle);
    return $files;
}

?>
