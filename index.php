<?php 
require_once 'core/init.php';
$usersT  = '';
if ( !$user->is_loggedIn() ) {
      
}else{

	$usersT  = $foto->get_foto_email('users', 'email', Session::get('email'));

}

$carousel_f1		=	$news->get_info_home('category', 'FORMULA-1');
$carousel_motogp	=	$news->get_info_home('category', 'MOTOGP');
$carousel_nba		=	$news->get_info_home('category', 'NBA');
$carousel_football	=	$news->get_info_home('category', 'FOOTBALL');

$carousel_f1 		=	mysqli_fetch_assoc($carousel_f1);
$carousel_motogp	=	mysqli_fetch_assoc($carousel_motogp);
$carousel_nba		=	mysqli_fetch_assoc($carousel_nba);
$carousel_football	=	mysqli_fetch_assoc($carousel_football);
require_once 'template/header.php';
?>

<div class="container-fluid container-headline">
	
	<div class="container-fluid line-bottom">
		
		<div class="row">
		
			<div class="col-sm-9 headline">				
				<h2 class="headline-text">HEADLINE</h2>	
			</div>
		
			<div class="col-sm-3 searching">
		
				<form action="news.php" method="post">
					<div class="form-group row">
				    	<div class="col-sm-10 input-searching">
				    		<input type="text" class="form-control input-searching" id="searching" name="searching" placeholder="searching..">
					      	<input type="hidden" name="token" value="<?= Token::generate();?>">
					      	
				    	</div>
				  	</div>
				</form>
		
			</div>
		
		</div>
	
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-8">
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
					
					<div class="carousel-inner">
					    
					    <div class="carousel-item active">
					    	<a href="single-news.php?id=<?= $carousel_f1['id'];?>&category=<?= $carousel_f1['category'];?>">
						    <img class="d-block w-100" src="<?= $carousel_f1['image']; ?>" alt="First slide" style="height: 450px;">
						    <div class="carousel-caption container-fluid caption-bucket">
							    <h5 class="headline-texts"><?= $carousel_f1['title']; ?></h5>
							    <p class="headline-texts">READ MORE</p>
							</div>
							</a>
					    </div>
					    
					    <div class="carousel-item">
					    	<a href="single-news.php?id=<?= $carousel_motogp['id'];?>&category=<?= $carousel_motogp['category'];?>">
					      	<img class="d-block w-100" src="<?= $carousel_motogp['image']; ?>" alt="Second slide" style="height: 450px;">
					      	<div class="carousel-caption container-fluid caption-bucket">
							    <h5 class="headline-texts"><?= $carousel_motogp['title']; ?></h5>
							    <p class="headline-texts">READ MORE</p>
							</div>
							</a>
					    </div>
					    
					    <div class="carousel-item">
					    	<a href="single-news.php?id=<?= $carousel_nba['id'];?>&category=<?= $carousel_nba['category'];?>">
					      	<img class="d-block w-100" src="<?= $carousel_nba['image']; ?>" style="height: 450px;">
					      	<div class="carousel-caption container-fluid caption-bucket">
							    <h5 class="headline-texts"><?= $carousel_nba['title']; ?></h5>
							    <p class="headline-texts">READ MORE</p>
							</div>
							</a>
					    </div>
					    
					    <div class="carousel-item">
					    	<a href="single-news.php?id=<?= $carousel_football['id'];?>&category=<?= $carousel_football['category'];?>">
					      	<img class="d-block w-100" src="<?= $carousel_football['image']; ?>" alt="Four slide" style="height: 450px;">
					      	<div class="carousel-caption container-fluid caption-bucket">
							    <h5 class="headline-texts"><?= $carousel_football['title']; ?></h5>
							    <p class="headline-texts">READ MORE</p>
							</div>
							</a>
					    </div>
					
					</div>
					<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
					    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
					    <span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
					    <span class="carousel-control-next-icon" aria-hidden="true"></span>
					    <span class="sr-only">Next</span>
					</a>
				</div>
			</div>

<?php
$carousel_f1_1			=	$news->get_info_home_child('category', 'FORMULA-1');
$carousel_motogp_1		=	$news->get_info_home_child('category', 'MOTOGP');
$carousel_nba_1			=	$news->get_info_home_child('category', 'NBA');
$carousel_football_1	=	$news->get_info_home_child('category', 'FOOTBALL');

$carousel_f1_1			=	mysqli_fetch_assoc($carousel_f1_1);
$carousel_motogp_1		=	mysqli_fetch_assoc($carousel_motogp_1);
$carousel_nba_1			=	mysqli_fetch_assoc($carousel_nba_1);
$carousel_football_1	=	mysqli_fetch_assoc($carousel_football_1);
?>
			<div class="col-sm-4">
				<div class="col-sm-12">
					<a href="https://www.shopee.co.id"><img src="assets/img/shopee.jpg" class="img-fluid"></a>	
				</div>
				
				<hr class="naer">
				
				<div class="col-sm-12">
					<a href="single-news.php?id=<?= $carousel_football_1['id'];?>&category=<?= $carousel_football_1['category'];?>">
						<img src="<?= $carousel_football_1['image']; ?>" class="img-fluid">
						<div class="carousel-caption caption-buckets">
							<h6 class="headline-texts"><?= $carousel_football_1['title'];?></h6>
							<p class="headline-texts">READ MORE</p>
						</div>
					</a>	
				</div>
			</div>

		</div>
	</div>
</div>

<div class="container-fluid ">
	<div class="container-fluid container-childern-news">
		<div class="row">
			<div class="col-sm-4 news-line">
				<a href="single-news.php?id=<?= $carousel_nba_1['id'];?>&category=<?= $carousel_nba_1['category'];?>">
					<img src="<?= $carousel_nba_1['image'];?>" class="img-fluid">
					<div class="carousel-caption caption-buckets">
						<h6 class="headline-texts"><?= $carousel_nba_1['title'];?></h6>
						<p class="headline-texts">READ MORE</p>
					</div>
				</a>
			</div>
			<div class="col-sm-4 news-line">
				<a href="single-news.php?id=<?= $carousel_motogp_1['id'];?>&category=<?= $carousel_motogp_1['category'];?>">
					<img src="<?= $carousel_motogp_1['image']; ?>" class="img-fluid">
					<div class="carousel-caption caption-buckets">
						<h6 class="headline-texts"><?= $carousel_motogp_1['title'];?></h6>
						<p class="headline-texts">READ MORE</p>
					</div>
				</a>
			</div>
			<div class="col-sm-4 news-line">
				<a href="single-news.php?id=<?= $carousel_f1_1['id'];?>&category=<?= $carousel_f1_1['category'];?>">
					<img src="<?= $carousel_f1_1['image'];?>" class="img-fluid">
					<div class="carousel-caption caption-buckets">
						<h6 class="headline-texts"><?= $carousel_f1_1['title'];?></h6>
						<p class="headline-texts">READ MORE</p>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>
<br>
<?php require_once 'template/footer.php'; ?>