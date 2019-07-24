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

						$fields = array( 'image' => $files_destination );
						
						if ( $news->updating_news($fields, Input::get('id') ) ){
							move_uploaded_file($files_location, $files_destination);
							Session::set('msg','Image have been changed!');
							header('Location: news.php?category='.$fields['category']);
						}else{
							$errors	= "Changing Image is failed!";
						}
					}else{
						$files_destination 	=	$files_destination;
						
						$fields = array( 'image' => $files_destination );
						
						if ( $news->updating_news($fields, Input::get('id') ) ){
							move_uploaded_file($files_location, $files_destination);
							Session::set('msg','Image have been changed!');
							header('Location: news.php?category='.$fields['category']);
						}else{
							$errors	= "Changing Image is failed!";
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
		<?php 
			while ($row = mysqli_fetch_assoc($showing)) { 
		?>
		<h3>CHANGE - IMAGE NEWS</h3>
		<hr style="background-color: rgba(29, 29, 29, 0.8); height: 0.5px;">
		<form name="foo" action="" method="post" enctype="multipart/form-data">
			<input type="hidden" name="id" id="id" value="<?= $row['id'];?>">
  			<div class="form-group">
  				<center>
  					
				    <div class="col-sm-4">
				    	<img src="<?= $row['image']; ?>" class="img-fluid" id="img-news">
				    </div>
				    <div class="col-sm-4">	
				      	<input type="file" class="form-control" id="image" name="image" onchange="ShowsPreview(this,'img-news')">
				    </div>
  				</center>
  			</div>
  			<br>
  			<hr style="background-color: rgba(29, 29, 29, 0.8); height: 0.5px;">
  			
  			<input type="hidden" name="user" id="user" value="<?= $usersT['name']; ?>">
			<input type="hidden" name="token" value="<?= Token::generate(); ?>">
  			
  			<p style="text-align: center;">
  				<input type="submit" name="submit" value="SAVE" class="btn btn-outline-primary">
  				<a href="news.php?category=<?= $row['category']; ?>" class="btn btn-outline-secondary">CANCEL</a>
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
<script type="text/javascript">
  function ShowsPreview(image,idpreview)
  {
    var gb = image.files;
    for (var i = 0; i < gb.length; i++)
    {
      var gbPreview = gb[i];
      var imageType = /image.*/;
      var preview=document.getElementById(idpreview);
      var reader = new FileReader();
      if (gbPreview.type.match(imageType))
      {
        //jika tipe data sesuai
        preview.file = gbPreview;
        reader.onload = (function(element)
        {
          return function(e)
          {
            element.src = e.target.result;
          };
        })(preview);
        //membaca data URL gambar
        reader.readAsDataURL(gbPreview);
      }
        else
        {
          //jika tipe data tidak sesuai
          alert("Tipe file tidak sesuai. Gambar harus bertipe .jpg atau .jpeg.");
          return false;
        }
    }
  }
</script>