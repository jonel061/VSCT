
<?php
include '../inc/header.php';
Session::CheckLogin();
?>


<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
   $userLog = $users->userLoginAuthotication($_POST);
}
if (isset($userLog)) {
  echo $userLog;
}

$logout = Session::get('logout');
if (isset($logout)) {
  echo $logout;
}



 ?>

<div class="card ">
  <div class="card-header">
          <h3 class='text-center' style="color: #07c5f8"><i class="fas fa-sign-in-alt mr-2"></i>/logare</h3>
        </div>
        <div class="card-body">


            <div style="width:450px; margin:0px auto">

            <form class="" action="" method="post">
                <div class="form-group">
                  <label for="email">Adresa email</label>
                  <input type="email" name="email"  class="form-control">
                </div>
                <div class="form-group">
                  <label for="password">Parola</label>
                  <input type="password" name="password"  class="form-control">
                </div>
                <div class="form-group">
                  <button type="submit" name="login" class="btn btn-success" style="background-color: #07c5f8" >Logare</button>
                </div>


            </form>
          </div>


        </div>
      </div>



  <?php
  include '../inc/footer.php';

  ?>