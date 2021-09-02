<?php
include '../inc/header.php';
Session::CheckSession();
 ?>
 <?php

 if (isset($_GET['id'])) {
   $userid = (int)$_GET['id'];

 }



 if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changepass'])) {
    $changePass = $users->changePasswordBysingelUserId($userid, $_POST);
 }



 if (isset( $changePass)) {
   echo  $changePass;
 }
  ?>


 <div class="card ">
   <div class="card-header">
          <h3>Schimbați-vă parola<span class="float-right"> <a href="http://localhost/Proiect_pw/Public/profile?id=<?php  ?>" class="btn btn-primary">Înapoi</a> </h3>
        </div>
        <div class="card-body">



          <div style="width:600px; margin:0px auto">

          <form class="" action="" method="POST">
              <div class="form-group">
                <label for="old_password">Parola veche</label>
                <input type="password" name="old_password"  class="form-control">
              </div>
              <div class="form-group">
                <label for="new_password">Parola nouă</label>
                <input type="password" name="new_password"  class="form-control">
              </div>


              <div class="form-group">
                <button type="submit" name="changepass" class="btn btn-success">Schimbă parola</button>
              </div>


          </form>
        </div>


      </div>
    </div>


  <?php
  include '../inc/footer.php';

  ?>