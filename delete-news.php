<?php 

require_once 'core/init.php';

$usersT  = '';
$showing='';
$token='';
if ( !$user->is_loggedIn() ) {
      
}else{

	$usersT  = $foto->get_foto_email('users', 'email', Session::get('email'));

}

if (!isset($_GET['id'])) {
	header('Location: news.php?category=FORMULA-1');
}else{
	$showing	=	$news->showing_news('id' ,Input::get('id'));
	$token 		=	Token::generate();
}

$errors='';
while ($row = mysqli_fetch_assoc($showing)) {
	if ( Token::check( $token ) ) {
		if ( $news->deleting_news( Input::get('id') ) ) {
			header('Location: news.php?category='.$fields['category']);
			Session::set('msg_danger','News have been Deleted!');
		}else { $errors	= "Edited News is failed!"; }
	}else{
		header('Location: news.php?category='.$row['category']);
	}
}
?>