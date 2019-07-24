<?php
require_once 'core/init.php';
$errors='';
if (Input::get('submit')) {
	if ( Token::check( Input::get('token') ) ) {
		$files 				= $_FILES['image'];
		$unique				=	time();
		$files_name			=	$files['name'];
		$files_location		=	$files['tmp_name'];
		$files_error		=	$files['error'];
		$files_size			=	$files['size'];
		$files_type			=	$files['type'];
		$files_destination	=	'assets/img/news/'.$files_name;
		
		if ($files_error==0) {
			
			if ($files_type === 'image/jpg' || $files_type === 'image/jpeg') {
				
				if ($files_size <= 1000000) {
					
					if (file_exists($files_destination)) {
						$files_destination	=	str_replace(".jpg", "", $files_destination);
						$files_destination	=	$files_destination."_".$unique.".jpg";
						
					}else{
						$files_destination 	=	$files_destination;
					}

				}else{  $errors = "Image Size is too large!"; }
			
			}else{ $errors = "Image type must jpg/jpeg!"; }
		
		}else{ $errors = "There is something problem when uploading image!"; } 
			
	}
}

?>