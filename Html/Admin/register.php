<?php
include '../inc/header.php';
Session::CheckLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {

  $register = $users->userRegistration($_POST);
}

if (isset($register)) {
  echo $register;
}


 ?>


 <div class="card ">
   <div class="card-header">
          <h3 class='text-center' style="color:#07c5f8">Creare cont</h3>
        </div>
        <div class="cad-body">



            <div style="width:600px; margin:0px auto">

            <form class="" action="" method="post">
                <div class="form-group pt-3">
                  <label for="name">Nume</label>
                  <input type="text" name="name"  class="form-control">
                </div>
                <div class="form-group">
                  <label for="username">Prenume</label>
                  <input type="text" name="username"  class="form-control">
                </div>
                <div class="form-group">
                  <label for="email">Adresa email</label>
                  <input type="email" name="email"  class="form-control">
                </div>
                <div class="form-group">
                  <label for="mobile">Numărul de telefon</label>
                  <input type="text" name="mobile"  class="form-control">
                </div>
                <div class="form-group">
                  <label for="password">Parola</label>
                  <input type="password" name="password" class="form-control">
                  <input type="hidden" name="roleid" value="3" class="form-control">
                </div>
                <div class="form-group">
                  <button type="submit" name="register" class="btn btn-success" style="background-color:#07c5f8">Registrare</button>
                </div>


            </form>
          </div>


        </div>
      </div>



  <?php
  include '../inc/footer.php';

  ?>