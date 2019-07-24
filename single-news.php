<?php 

require_once 'core/init.php';
$usersT  = '';
if ( !$user->is_loggedIn() ) {
      
}else{

	$usersT  = $foto->get_foto_email('users', 'email', Session::get('email'));

}

if (!isset($_GET['id'])) {
	header('Location: news.php?category=FORMULA-1');
}else{
	$showing	=	$news->get_info_id('id' ,Input::get('id'));
}

require_once 'template/header.php'; 
?>

<div class="container-fluid">
	<div class="container">
			<br><br>
			<div class="row">
				<div class="col-sm-4">
					<form action="news.php" method="post">
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
			while ($row = mysqli_fetch_assoc($showing)) { 
			?>

				<div class="col-sm-12" style="text-align: justify;">
					<h3 class="title-list"><?= $row['title'];?></h3>
				</div>

				<div style="background-color: rgba(29, 29, 29, 0.8);">
				<center>
					<div class="col-sm-8">
						<img src="<?= $row['image'];?>" alt="News1" class="img-fluid">		
					</div>
				</center>
				</div>
				
				<br>
				<center>
					<div class="col-sm-8">
						<article>
							<p class="news-content" style="text-align: justify; text-indent: 0.3in;">
								<?= str_replace(".<br>", ".<br><br>", $row['text']) ;?>
							</p>
						</article>	
					</div>
				</center>
				

				<hr class="naer">

				<div class="col-sm-12" style="text-align: justify; overflow: hidden;">
					<p ><h5>Tags</h5></p>
					
					<p class="news-content">
						<?php $taging = explode(" ", $row['tags']); ?>
						<?php
							
							$valueArray = array();
							$i=0; 
							foreach ($taging as $key => $value) {
								echo $valueArray[$i] = "<a href='https://www.google.com/search?q=".str_replace("#", "", $value)."' class='btn btn-primary' style='margin-bottom: 1%; margin-left: 0.3%;'>".$value."</a>";
							$i++;
							}
						?>
					</p>
					<p class="news-content">
						Source : <a href="https://www.<?= $row['source'];?>"><?= $row['source']; ?></a>
					</p>
					<p class="news-content">
						Writer :<?= $row['writer']; ?>
					</p>
				</div>
			<?php
				}
			?>
			<br>
		</div>
	</div>
</div>


<?php require_once 'template/footer.php'; ?>