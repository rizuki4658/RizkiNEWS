<?php 

require_once 'core/init.php';

$usersT  = '';
$showing='';
if ( !$user->is_loggedIn() ) {
      
}else{

	$usersT  = $foto->get_foto_email('users', 'email', Session::get('email'));

}

if (!isset($_GET['id'])) {
	header('Location: news.php?category=FORMULA-1');
}else{
	$showing	=	$news->get_info_id('id' ,Input::get('id'));
}

$errors='';
if (Input::get('submit')) {
	if ( Token::check( Input::get('token') ) ) {
		$fields = array(
						'title'		=> Input::get('title'),
						'category'	=> Input::get('category'),
						'tags'		=> Input::get('tags'),
						'source'	=> Input::get('source'),
						'text'		=> Input::get('text'),
						'writer'	=> Input::get('user')
						);
		
		if ( $news->updating_news( $fields, Input::get('id') ) ) {
			header('Location: news.php?category='.$fields['category']);
			Session::set('msg','News have been edited!');
		}else { $errors	= "Edited News is failed!"; }
	}
}

require_once 'template/header.php'; 
?>

<div class="container-fluid">
	<div class="container">
		<br><br>
		<h3>EDIT - NEWS</h3>
		<hr style="background-color: rgba(29, 29, 29, 0.8); height: 0.5px;">
		<?php 
			while ($row = mysqli_fetch_assoc($showing)) { 
		?>
		<form name="foo" action="" method="post" enctype="multipart/form-data">
			<input type="hidden" name="id" id="id" value="<?= $row['id'];?>">
			<div class="form-group row">
    			<label for="title" class="col-sm-2 col-form-label">Title</label>
			    <div class="col-sm-10">
			      	<input type="text" class="form-control" id="title" name="title" placeholder="Title" required="" value="<?= $row['title'];?>">
			    </div>
  			</div>
  			<div class="form-group row">
    			<label for="category" class="col-sm-2 col-form-label">Category</label>
			    <div class="col-sm-10">
			      	<select class="form-control" id="category" name="category" placeholder="Category" required="">
			      		<option><?= $row['category']; ?></option>
			      		<option>Selects</option>
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
			      	<textarea class="form-control" id="tags" name="tags" placeholder="#tags"><?= $row['tags']; ?></textarea>
			    </div>
  			</div>
  			<div class="form-group row">
    			<label for="source" class="col-sm-2 col-form-label">Source</label>
			    <div class="col-sm-10">
			      	<input type="text" class="form-control" id="source" name="source" placeholder="Source" required="" value="<?= $row['source'];?>">
			    </div>
  			</div>
  			<br>
  			<textarea name="text" id="text" class="form-control" required="" placeholder="Type News Here" rows="20"><?= $row['text'];?></textarea>
  			<br>
  			
  			<hr style="background-color: rgba(29, 29, 29, 0.8); height: 0.5px;">
  			
  			<input type="hidden" name="user" id="user" value="<?= $usersT['name']; ?>">
			<input type="hidden" name="token" value="<?= Token::generate(); ?>">
  			
  			<p style="text-align: center;">
  				<input type="submit" name="submit" value="SAVE" class="btn btn-outline-primary">
  				<input type="reset" name="reset" value="CANCEL" class="btn btn-outline-secondary">
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
		<?php
		}
		?>
	</div>
</div>
<br>

<?php require_once 'template/footer.php'; ?>
