<?php 

require_once 'core/init.php';
$usersT  = '';
$showing='';
$searching='';
$total=0;
$pages=0;
if ( !$user->is_loggedIn() ) {
      
}else{
	$usersT  = $foto->get_foto_email('users', 'email', Session::get('email'));

}

if (Input::get('category')) {
	$perpage	=3;
	$showing	=	$news->showing_news('category' , Input::get('category'), Input::get('page'), $perpage);
	$showing_all=	$news->showing_all_news('category' , Input::get('category'));
	$total=mysqli_num_rows($showing_all);
	$pages		= ceil($total/$perpage);
}else{
	$perpage	=3;
	$showing	=	$news->showing_news('' , '', Input::get('page'), $perpage);
	$showing_all=	$news->showing_all_news('' , '');
	$total		=mysqli_num_rows($showing_all);
	$pages		= ceil($total/$perpage);
}

if (Input::get('searching')) {
	if (Token::check(Input::get('token'))) {
		$fields	= array(
						'title'		=> Input::get('searching'),
						'category'	=> Input::get('searching'),
						'tags'		=> Input::get('searching')

					);
		$searching = $news->searching($fields);
		//die(print_r($searching));
	}
}
require_once 'template/header.php'; 
?>

<div class="container-fluid">
	<div class="container">
			<br><br>
			<?php
  				if (isset($_SESSION['msg'])) { ?>
  				
  					<div class="alert with-close alert-success alert-dismissible fade show">
  						<center>
                    		<i class="ti-thumb-up"></i><?= $_SESSION['msg'];?>
                    	</center>
	                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                      <span aria-hidden="true">×</span>
	                    </button>
                  	</div>
  			<?php
  					unset($_SESSION['msg']);
  				}elseif(isset($_SESSION['msg_danger'])){
  			?>

  					<div class="alert with-close alert-danger alert-dismissible fade show">
  						<center>
                    		<i class="ti-trash"></i> <?= $_SESSION['msg_danger'];?>
                    	</center>
	                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                      <span aria-hidden="true">×</span>
	                    </button>
                  	</div>

  			<?php
  					unset($_SESSION['msg_danger']);
  				}
  			?>
			<div class="row">
				<div class="col-sm-8 btn-bucket">
					<?php if (!empty($usersT)) { ?>
						<a href="add-news.php" class="btn btn-outline-primary btn-add">ADD NEWS</a> 
					<?php } ?>
				</div>
				<div class="col-sm-4">
					<form action="" method="post">
					  	<div class="form-group row">
					    	<div class="col-sm-10">
					      		<input type="text" name="searching" id="searching" class="form-control" id="staticEmail" placeholder="searching..">
					      		<input type="hidden" name="token" value="<?= Token::generate();?>">
					    	</div>
					  	</div>
					</form>
				</div>
			</div>
			<hr class="naer">
			
			<?php
			if (empty($searching)) {
			
				while ($row = mysqli_fetch_assoc($showing)) { 
			?>

			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-4">
						<img src="<?= $row['image']; ?>" alt="News1" class="img-fluid">
						<br>
						<?php if (!empty($usersT)) { ?>
						<a href="change-image.php?id=<?= $row['id'];?>" class="btn btn-outline-success" style="margin-top: 1%;"><i class="ti-image"></i> CHANGE</a>
						<?php } ?>
					</div>
					<div class="col-sm-6 news-list">
						<h2 class="title-list"><a href="single-news.php?id=<?= $row['id'];?>&category=<?= $row['category'];?>"><?= $row['title']; ?></a></h2>
						<p class="news-content" style="text-align: justify;">
							<?= substr($row['text'], 0,300);?><a href="single-news.php?id=<?= $row['id'];?>&category=<?= $row['category'];?>"> ....</a>
						</p>
					<?php if (!empty($usersT)) { ?>
						<a href="edit-news.php?id=<?= $row['id'];?>" class="btn btn-outline-warning btn-add" onclick="return confirm('Are you sure to edit this news <?= $row['title']; ?>');">EDIT</a>
						<?php if($usersT=='ADMIN'){ ?>
						<a href="delete-news.php?id=<?= $row['id'];?>" class="btn btn-outline-danger btn-add" onclick="return confirm('Are you sure to delete this news <?= $row['title']; ?>');">DELETE</a>
						<?php } ?>
					<?php } ?>
					</div>
				</div>
				<hr>
			</div>

			<?php
				}
			}else{
				if (mysqli_num_rows($searching)>0) {
					while ($row = mysqli_fetch_assoc($searching)) { ?>


			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-4">
						<img src="<?= $row['image']; ?>" alt="News1" class="img-fluid">
						<br>
						<?php if (!empty($usersT)) { ?>
						<a href="change-image.php?id=<?= $row['id'];?>" class="btn btn-outline-success" style="margin-top: 1%;"><i class="ti-image"></i> CHANGE</a>
						<?php } ?>
					</div>
					<div class="col-sm-6 news-list">
						<h2 class="title-list"><a href="single-news.php?id=<?= $row['id'];?>&category=<?= $row['category'];?>"><?= $row['title']; ?></a></h2>
						<p class="news-content" style="text-align: justify;">
							<?= substr($row['text'], 0,300);?><a href="single-news.php?id=<?= $row['id'];?>&category=<?= $row['category'];?>"> ....</a>
						</p>
					<?php if (!empty($usersT)) { ?>
						<a href="edit-news.php?id=<?= $row['id'];?>" class="btn btn-outline-warning btn-add" onclick="return confirm('Are you sure to edit this news <?= $row['title']; ?>');">EDIT</a>
						<a href="delete-news.php?id=<?= $row['id'];?>" class="btn btn-outline-danger btn-add" onclick="return confirm('Are you sure to delete this news <?= $row['title']; ?>');">DELETE</a>
					<?php } ?>
					</div>
				</div>
				<hr>
			</div>	

			<?php
					}
				}else{ ?>

				<div class="alert with-close alert-danger alert-dismissible fade show">
  					<h1 style="display: inline-block;"><i class="ti-face-sad"></i> Sorry!</h1>
  					No Results <a href="news.php?category=<?= Input::get('category');?>">go back</a>
                </div>

			<?php
				}
			} 			 
			?>
			<hr class="naer">


			<div class="row">
				<div class="col-sm-12" style="text-align: center;">
					<div class="">
						<?php if (empty($searching)) { ?>
							<?php for($i=1; $i<=$pages; $i++){ ?>
								<a href="?category=<?=Input::get('category');?>&page=<?= $i; ?>"> <?= $i; ?></a>
							<?php } ?>
						<?php } ?>
					</div>
				</div>
			</div>
			<br>
		</div>
	</div>
</div>


<?php require_once 'template/footer.php'; ?>