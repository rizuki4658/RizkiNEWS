<?php


	require_once 'core/init.php';

	if (Input::get('id')) {
		if ( $user->delete_user(Input::get('id')) ) {
        	header('Location: user-list.php');
      	}
	}else{
		Redirect::to('user-list.php');
	}

?>