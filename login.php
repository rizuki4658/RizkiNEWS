<?php
require_once 'core/init.php';
  

  $errors = '';
  if (Input::get('sign_in')) {
     
    if (Token::check( Input::get('token')) ) {
      
      if ($user->cek_email(Input::get('email'))) {
        
        if ( $user->login_user( Input::get('email'), Input::get('password') ) ) {
            Session::set('email', Input::get('email'));
            header('Location: index.php'); 
        }else{
            
          $errors = "Login Failed !";          
        }

      } else {
        $errors = "Email is Not Registered!<a href='register.php' class='badge badge-pill badge-danger'> Register Now </a>";
      }

    } 
  
  }


require_once 'template/header.php';   
?>
  
<div class="container-fluid">
  <br><br>
  
  <center>
    <div class="container login-form">
      <form class="form-signin" action="" method="post">
      <hr class="naers">
        
        <?php if (!empty($errors)) { ?>
          <div class="alert with-close alert-danger alert-dismissible fade show">
            <?= $errors; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
        <?php } ?>
        
        <h1 class="h3 mb-3 font-weight-normal"><i class="ti-joomla"></i></h1>
        <h1 class="h3 mb-3 font-weight-normal">LOGIN</h1>
        <label for="email" class="sr-only">Email address</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required="" autofocus="">
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
        <br>
      <hr class="naers">

      <input type="submit" name="sign_in" id="sign_in" class="btn btn-md btn-primary btn-block" value="Sign In">
      <input type="hidden" name="token" value="<?= Token::generate(); ?>">
      </form>
      <p></p>
      <a href="register.php">Register for an account?</a>
    </div>
  </center>
  
</div>
<br><br>
    

<?php require_once 'template/footer.php'; ?>