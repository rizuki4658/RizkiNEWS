<!DOCTYPE html>
<html>
<head>
	<title>CLNEWS | NEWS SPORT PORLTAL</title>
	<link href="assets/img/New Project (9).png" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/awesome/css/themify-icons.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
	<div class="container-fluid container-logo">
		<header>
			
			<div class="container-fluid header-img-logo">
			
				<div class="row">
			
					<div class="col-sm-6 img-header">
						<img src="assets/img/New Project (10).png" class="img-fluid hidden-image">
					</div>
			
					<div class="col-sm-6 sider-img">
						
						<div class="row columns">
							
							<div class="col-sm-4">	
								<div class="for-logo-img">
									<h1 class="logo">CL</h1>
									<h1 class="logo">NEWS</h1>
								</div>
							</div>

							<div class="col-sm-3 bg-img">
								<img src="assets/img/New Project (9).png" class="img-fluid logo">
								<!--<a class="btn btn-outline-primary" href="login.php" style="padding: 1% 2%; width: 100%;">Login</a>-->
							</div>
						
						</div>
				
					</div>
				
				</div>
			
			</div>


			<div class="container-fluid container-navbar">
				
				<nav class="navbar navbar-expand-lg childern-navbar">
			  		<a class="navbar-brand" href="index.php">CLNEWS</a>
			  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    		<span class="navbar-toggler-icon"></span>
			  		</button>

			  		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			    		
			    		<ul class="navbar-nav mr-auto" >
			      			
			      			<li class="nav-item">
			        			<a class="nav-link" href="news.php?category=FORMULA-1"> FORMULA-1</a>
			      			</li>
					      	
					      	<li class="nav-item">
					        	<a class="nav-link" href="news.php?category=MOTOGP">MOTOGP</a>
					      	</li>
						    
						    <li class="nav-item">
						        <a class="nav-link" href="news.php?category=NBA">NBA</a>
						    </li>
						
						    <li class="nav-item">
						        <a class="nav-link" href="news.php?category=FOOTBALL">FOOTBALL</a>
						    </li>
			    		
			    		</ul>
			     		
			     		<ul class="navbar-nav">

						<?php if( Session::exists('email') ){ ?>    
						
						<?php }else{ ?>    
						    <li class="nav-item">
						    	<a class="nav-link" href="register.php">REGISTER</a>
						    </li>
						    
						    <li class="nav-item">
						      	<a class="nav-link" href="login.php">LOGIN</a>
						    </li>
			      		<?php } ?>

			      		<?php if( Session::exists('email') ){ ?>
			      			
			      			<li class="nav-item dropdown">
			        			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			        				<?= $_SESSION['email'];?>
			        				
				        			<img width="20" src=" <?php echo $usersT['foto']; ?>">
				    			</a>
							    <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="">
							        <a class="dropdown-item" href="profile.php?id=<?= $usersT['id']; ?>">PROFILE</a>
							        <a class="dropdown-item" href="user-list.php">USER LIST</a>
							        <a class="dropdown-item" onclick="return confirm('Are you sure to Logout?')" href="logout.php">LOGOUT</a>
							    </div>
			      			</li>
			    		<?php }else{ ?>

			    		<?php } ?>
			    		</ul>
			  		
			  		</div>
				
				</nav>
			</div>
		
		</header>
	</div>