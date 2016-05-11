<?php	
	//File to download
	$file = $_GET['photo'];
	
	if (file_exists("fb_images/".$file)) {
		header("Cache-control: private");
		header("Content-Type: image/jpeg");
		header("Content-Disposition: attachment; filename = ".$file);
		readfile("fb_images/".$file);
	}
	
	exit;

?> 
