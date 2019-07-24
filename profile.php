<?php 
require_once 'core/init.php';

if ( !$user->is_loggedIn() ) {
    Redirect::to('login');  
  }

$users='';
$errors='';
$usersT  = $foto->get_foto_email('users', 'email', Session::get('email'));

if (isset($_GET['id'])) {
  $users  = $user->get_user_id('users', 'id', Input::get('id'));
}

if (Input::get('UPLOAD')) {
  if (Token::check( Input::get('token') )) {
      $id               = Input::get('id');
      $image            = $_FILES['picture'];
      $unique           = time();
      $file_name        = $image['name'];
      $file_location    = $image['tmp_name'];
      $error            = $image['error'];
      $file_size        = $image['size'];
      $file_type        = $image['type'];
      $file_destination ='assets/img/upload/'.$file_name;
      if ($error == 0) {
        if ($file_type === 'image/jpg' || $file_type === 'image/jpeg') {
          if ($file_size <= 1000000) {
            if (file_exists($file_destination)) {
              $file_destination = str_replace(".jpg", "", $file_destination);
              $file_destination = $file_destination."_".$unique.".jpg";
              if ( $foto->update_foto($fileds = array('foto' => $file_destination), $id) ) {
                  move_uploaded_file($file_location, $file_destination);
                  $users  = $foto->get_foto_email('users', 'email', Session::get('email'));
              }else{
                $errors = "UPLOAD Was Failed!";  
              }
            }else{
              if ( $foto->update_foto($fileds = array('foto' => $file_destination), $id) ) {
                  move_uploaded_file($file_location, $file_destination);
                  $users  = $foto->get_foto_email('users', 'email', Session::get('email'));
              }else{
                $errors = "UPLOAD Was Failed!";  
              }
            }
          }else{
            $errors ="There is Probem When Start to UPLOAD!";
          }
        }else{
          $errors ="Your File type Is not Valid (try using type jpeg or jpg)"; 
        }
      }else{
        $errors ="There is Probem When Start to UPLOAD!";
      }
  }
}

if (Input::get('proses_status')){
  if (Token::check( Input::get('keytoken') )) {
    if (Input::get('status')) {
      if ( $user->update_user($fileds = array('status' => Input::get('status')), Input::get('keyid')) ) {
        header('Location: user-list.php');
      }else{
        $errors = "UPDATED User Status Was Failed!";
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
          <div class="card" style="width: 100%; padding: 1% 1%;">
            <?php if (Session::get('email') === $users['email']) { ?>
              <div id="ti-edit">
              
                <button type="button" id="edit_foto_klik" class="btn btn-success"><i class="ti-pencil"></i> CHANGE FOTO</button>
              
              </div>
            
              <div id="ti-upload" style="display: none;">
                <form enctype="multipart/form-data" action="" method="post">
                  <input type="hidden" name="id" id="id" value="<?= $users['id']; ?>">
                  <input type="hidden" name="token" value="<?= Token::generate(); ?>">
                  
                  
                  <input type="file" name="picture" id="picture" class="form-control" style="margin-bottom: 1%;" required="" onchange="ShowsPreview(this,'img-profile')">
                  
                  <input name="UPLOAD" type="submit" class="btn btn-success" value="UPLOAD">
                  
                  <input name="CANCEL" type="reset" class="btn btn-danger" id="ti-trash" value="CANCEL">
                </form>
                
              </div>
            <?php }else{ ?>

            <?php } ?>
            
            <br>

            <?php if (!empty($errors)) { ?>
                <div class="alert with-close alert-danger alert-dismissible fade show">
                  <?= $errors;?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
            <?php } ?>
            <img class="card-img-top" style="width: 50%;" src="<?php echo $users['foto']; ?>" alt="Card image cap" id="img-profile">
            
            <div class="card-body">
            
              <h5 class="card-title"><?= strtoupper($usersT['name']); ?></h5>
            
              <ul class="list-group list-group-flush" style=" text-align: justify;">
                <li class="list-group-item"><i class="ti-email"></i> <?= $usersT['email']; ?></li>
              </ul>
            
              <br>
            

            <?php if ($usersT['status']==='ADMIN') { ?>

              <form action="" method="post">
                <select name="status" class="btn btn-primary" required="">
                  <option><?= $users['status']; ?></option>
                  <option>USER</option>
                  <option>ADMIN</option>
                  <option>BLOCKED</option>
                </select>
                <input type="hidden" name="keytoken" value="<?= Token::generate(); ?>">
                <input type="hidden" name="keyid" value="<?= $users['id'];?>">
                <input type="submit" name="proses_status" class="btn btn-secondary" value="SAVE">
              </form>
            <?php } ?>
            
            </div>
          
          </div>
      </center>
    
    </div>
  </div>

<br><br>
<?php require_once 'template/footer.php'; ?>    

<script type="text/javascript">
  $(document).ready(function(){
    $('#edit_foto_klik').click(function(){
        $('#ti-upload').fadeIn(2000);
        $('#ti-edit').fadeOut(1000);
        return false;
    });
  });
</script>

<script type="text/javascript">
  function ShowsPreview(picture,idpreview)
  {
    var gb = picture.files;
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