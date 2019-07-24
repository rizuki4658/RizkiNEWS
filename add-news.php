<?php 

require_once 'core/init.php';

$usersT  = '';
if ( !$user->is_loggedIn() ) {
      
}else{

	$usersT  = $foto->get_foto_email('users', 'email', Session::get('email'));

}

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

						$fields = array(
						'id' 		=> '',
						'title'		=> Input::get('title'),
						'category'	=> Input::get('category'),
						'tags'		=> Input::get('tags'),
						'source'	=> Input::get('source'),
						'text'		=> Input::get('text'),
						'image'		=> $files_destination,
						'writer'	=> Input::get('user')
						);
						
						if ( $news->adding_news($fields) ){
							move_uploaded_file($files_location, $files_destination);
							Session::set('msg','News have been added!');
							header('Location: news.php?category='.$fields['category']);
						}else{
							$errors	= "Adding News is failed!";
						}
					}else{
						$files_destination 	=	$files_destination;
						
						$fields = array(
						'id' 		=> '',
						'title'		=> Input::get('title'),
						'category'	=> Input::get('category'),
						'tags'		=> Input::get('tags'),
						'source'	=> Input::get('source'),
						'text'		=> Input::get('text'),
						'image'		=> $files_destination,
						'writer'	=> Input::get('user')
						);
						
						if ( $news->adding_news($fields) ){
							move_uploaded_file($files_location, $files_destination);
							Session::set('msg','News have been added!');
							header('Location: news.php?category='.$fields['category']);
						}else{
							$errors	= "Adding News is failed!";
						}
					}

				}else{  $errors = "Image Size is too large!"; }
			
			}else{ $errors = "Image type must jpg/jpeg!"; }
		
		}else{ $errors = "There is something problem when uploading image!"; } 
			
	}
}
require_once 'template/header.php'; 
?>

<div class="container-fluid">
	<div class="container">
		<br><br>
		<h3>ADD - NEWS</h3>
		<hr style="background-color: rgba(29, 29, 29, 0.8); height: 0.5px;">
		<form action="" method="post" enctype="multipart/form-data">
			<div class="form-group row">
    			<label for="title" class="col-sm-2 col-form-label">Title</label>
			    <div class="col-sm-10">
			      	<input type="text" class="form-control" id="title" name="title" placeholder="Title" required="">
			    </div>
  			</div>
  			<div class="form-group row">
    			<label for="category" class="col-sm-2 col-form-label">Category</label>
			    <div class="col-sm-10">
			      	<select class="form-control" id="category" name="category" placeholder="Category" required="">
			      		<option></option>
			      		<option>FORMULA-1</option>
			      		<option>MOTOGP</option>
			      		<option>NBA</option>
			      		<option>FOOTBALL</option>
			      	</select>
			    </div>
  			</div>
  			<div class="form-group row">
    			<label for="tags" class="col-sm-2 col-form-label">Tags</label>
			    <div class="col-sm-10">
			      	<textarea class="form-control" id="tags" name="tags" placeholder="#tags"></textarea>
			    </div>
  			</div>
  			<div class="form-group row">
    			<label for="source" class="col-sm-2 col-form-label">Source</label>
			    <div class="col-sm-10">
			      	<input type="text" class="form-control" id="source" name="source" placeholder="Source" required="">
			    </div>
  			</div>
  			<br>
  			<textarea name="text" id="text" class="form-control" required="" placeholder="Type News Here"></textarea>
  			<br>
  			<div class="form-group row">
    			<label for="image" class="col-sm-2 col-form-label">Image</label>
			    <div class="col-sm-10">
			      	<input type="file" class="form-control" id="image" name="image" placeholder="" required="">
			    </div>
  			</div>
  			<br>
  			<hr style="background-color: rgba(29, 29, 29, 0.8); height: 0.5px;">
  			
  			<input type="hidden" name="user" id="user" value="<?= $usersT['name']; ?>">
			<input type="hidden" name="token" value="<?= Token::generate(); ?>">
  			
  			<p style="text-align: center;">
  				<input type="submit" name="submit" value="SAVE" class="btn btn-outline-primary">
  				<button type="reset" name="reset" class="btn btn-outline-secondary">CANCEL</button>
  			</p>

  			<?php
  				if (!empty($errors)) { ?>
  				
  					<div class="alert with-close alert-danger alert-dismissible fade show">
                    	<?= $errors;?>
	                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                      <span aria-hidden="true">×</span>
	                    </button>
                  	</div>
  			<?php
  				}
  			?>
		</form>
	</div>
</div>
<br>

<?php require_once 'template/footer.php'; ?>