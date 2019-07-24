<?php
  require_once 'core/init.php';

  $msg = '';
  $Success_Failed="";

  if (Input::get('register')) {
    if (Token::check(Input::get('token'))) {
      if ($user->cek_email(Input::get('Email'))) {
        $msg  = array('status' => 'Failed!', 'msg' => 'Email has been used.');
        $Success_Failed="Failed!"; 
      }else{
        if (Input::get('Password') != Input::get('Confirm')) {
          $msg  = array('status' => 'Sorry!', 'msg' => 'Confirmation Password is does not matchs.');
          $Success_Failed="Failed!";
        }else{
          if ( $user->register_user( array( 
                                            'id'        => "",
                                            'name'      => Input::get('Name'),
                                            'email'     => Input::get('Email'),
                                            'password'  => password_hash(Input::get('Password'), PASSWORD_DEFAULT),
                                            'status'    => 'USER',
                                            'foto'      => 'assets/img/user.png')
                                    )
              ){
              
            $msg  = array('status' => 'Success!', 'msg' => 'Your registration Successful login now!');
            $Success_Failed="Success!";
          }else{
            $msg  = array('status' => 'Failed!', 'msg'=>'Your registration Unsuccessful.');
            $Success_Failed="Failed!";
          }
        }
      }
    }
  }


  require_once 'template/header.php';
?>
<br><br>
    <div class="container-fluid">
      <div class="container login-form">
      <center>
          <form class="form-registration" action="" method="POST">
            <hr class="naers">
            <center><h3>REGISTERATION FORM</h3></center>
            <div class="form-group row">
              <label for="Name" class="col-sm-3 col-form-label">Name</label>
              <div class="col-sm-9">
                  <input type="text" class="form-control" id="Name" name="Name" placeholder="Your Name">
              </div>
            </div>
            <div class="form-group row">
              <label for="Email" class="col-sm-3 col-form-label">Email</label>
              <div class="col-sm-9">
                  <input type="email" class="form-control" id="Email" name="Email" placeholder="Email Address">
              </div>
            </div>
            <div class="form-group row">
              <label for="Password" class="col-sm-3 col-form-label">Password</label>
              <div class="col-sm-9">
                  <input type="password" class="form-control" id="Password" name="Password" placeholder="Password">
              </div>
            </div>
            <div class="form-group row">
              <label for="Confirm" class="col-sm-3 col-form-label">Confirm Password</label>
              <div class="col-sm-9">
                  <input type="password" class="form-control" id="Confirm" name="Confirm" placeholder="Confirm Password">
              </div>
            </div>
            

            <?php
              if (!empty($msg)) {
                if ($Success_Failed == "Failed!") { ?>

                  <div class="alert with-close alert-danger alert-dismissible fade show">
                    <span class="badge badge-pill badge-danger"><?= $msg['status']; ?></span>
                      <?= $msg['msg'];?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>    
            
            <?php 
                }else{ ?>

                <div class="alert with-close alert-success alert-dismissible fade show">
                  <span class="badge badge-pill badge-success"><?= $msg['status']; ?></span>
                    <?= $msg['msg']; ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>

            <?php
                }
              }

            ?>
            

            
            
            <input type="hidden" name="token" value="<?= Token::generate(); ?>">
            <hr class="naers">
            
            
            <input type="submit" name="register" id="register" class="btn btn-md btn-primary btn-block" value="REGISTER">
            <center>OR</center>
            <a href="login.php" class="btn-login">Already have an account!</a>
        </form>
     </center>
    </div>
    </div>

<br><br>
<?php require_once 'template/footer.php'; ?>    
