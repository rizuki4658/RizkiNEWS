<?php 

require_once 'core/init.php';

if ( !$user->is_loggedIn() ) {
    Redirect::to('login');  
  }

  
$usersT  = $foto->get_foto_email('users', 'email', Session::get('email'));
$users 	= $user->get_user('users');
$No		=1;

if (Input::get('searching')) {
	if (Token::check(Input::get('token'))) {
		$fields	= array(
						'name'		=> Input::get('searching'),
						'email'		=> Input::get('searching'),
						'status'	=> Input::get('searching')

					);
		$searching = $user->searching($fields);
		//die(print_r($searching));
	}
}
require_once 'template/header.php'; 
?>

<div class="container-fluid">
	<div class="container-fluid">
			<br><br>
			<div class="row">
				<div class="col-sm-8 btn-bucket"></div>
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
			
			<div class="col-sm-12">
				<table class="table">
					<thead class="thead-dark">
						<tr>
							<th> No. </th>
							<th> Nama </th>
							<th> Email </th>
							<th> Status </th>
							<th> <?php if ($usersT['status'] === 'ADMIN') { ?> Act <?php } ?></th>
						</tr>
					</thead>
					<tbody>
					<?php if (empty($searching)) { ?>
					
					<?php foreach ( $users as $_user ): ?>
						<tr>
							<td><?= $No; ?></td>
							<td><?= strtoupper($_user['name']); ?></td>
							<td><?= $_user['email']; ?></td>
							<td><?= strtoupper($_user['status']); ?></td>
							<td>
								<?php if ($usersT['status'] === 'ADMIN') { ?>

									<a href="profile.php?id=<?= $_user['id']; ?>&mail=<?= $_user['email']; ?>" class="btn btn-primary font-button"><i class="ti-eye"></i> PROFILE</a>
								
								<?php } ?>
								
								<?php if ($usersT['status'] === 'ADMIN') { ?>
									<a onclick="return confirm('This User Will Be Deleting!')" href="trash-user.php?id=<?= $_user['id']; ?>" class="btn btn-danger font-button"><i class="ti-trash"></i> DELETE</a>
								<?php } ?>
							</td>
						</tr>
					<?php $No++; ?>
					<?php endforeach; ?>

					<?php }else{ ?>
							<?php if (mysqli_num_rows($searching)>0) { ?>
							
								<?php while ( $row = mysqli_fetch_assoc($searching) ){ ?>
									<tr>
										<td><?= $No; ?></td>
										<td><?= strtoupper($row['name']); ?></td>
										<td><?= $row['email']; ?></td>
										<td><?= strtoupper($row['status']); ?></td>
										<td>
											<?php if ($usersT['status'] === 'ADMIN') { ?>

												<a href="profile.php?id=<?= $row['id']; ?>&mail=<?= $row['email']; ?>" class="btn btn-primary font-button"><i class="ti-eye"></i> PROFILE</a>
											
											<?php } ?>
											
											<?php if ($usersT['status'] === 'ADMIN') { ?>
												<a onclick="return confirm('This User Will Be Deleting!')" href="trash-user.php?id=<?= $row['id']; ?>" class="btn btn-danger font-button"><i class="ti-trash"></i> DELETE</a>
											<?php } ?>
										</td>
									</tr>
								<?php $No++; ?>
								<?php } ?>

					<?php
							}else{ ?>

							<tr>
								<td colspan="5">
									<div class="alert with-close alert-danger alert-dismissible fade show">
					  					<h1 style="display: inline-block;"><i class="ti-face-sad"></i> Sorry!</h1>
					  					No Results <a href="user-list.php">go back</a>
					                </div>
			                	</td>
			                </tr>
					<?php
							}
						  }
					?>
					
					</tbody>
				</table>
			</div>

			<br><br>
		</div>
	</div>
</div>


<?php require_once 'template/footer.php'; ?>