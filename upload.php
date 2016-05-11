<?php

// Include the class to merge the pictures
include("classes/merge.php");

/*
	This file receives the JPEG snapshot
	from webcam.swf as a POST request.
*/

// We only need to handle POST requests:
if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
	exit;
}

$folder = 'fb_images/';
$code = md5($_SERVER['REMOTE_ADDR'].rand());
$filename = $code.'.jpg';


$original = $folder.$filename;

// The JPEG snapshot is sent as raw input:
$input = file_get_contents('php://input');

$result = file_put_contents($original, $input);
if (!$result) {
	echo '{
		"error"		: 1,
		"message"	: "Failed save the image. Make sure you chmod the uploads folder and its subfolders to 777."
	}';
	exit;
}

// $f1 is the webcam picture
$f1 = $original;

// $f2 is the selected frame
$f2 = $_GET['frame'];

// Creating the object of the class
$imagem = new mergePictures($f1,$f2);

// Merge the pictures with the over method
$imagem->over();

// Save the new image in the fb_images folder
$imagem->save("fb_images",$code,"jpg");

echo '{
	"status":1,
	"message":"successfully",
	"filename":"'.$filename.'"
	}';

?>
