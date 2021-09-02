<?php
include '../inc/header.php';
Session::CheckSession();
$sId =  Session::get('roleid');
if ($sId === '1') { ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addUser'])) {

  $userAdd = $users->addNewUserByAdmin($_POST);
}

if (isset($userAdd)) {
  echo $userAdd;
}


 ?>


 <div class="card ">
   <div class="card-header">
          <h3 class='text-center' style="color: #07c5f8">Adăugare unui utilizator nou</h3>
        </div>
        <div class="cad-body">



            <div style="width:600px; margin:0px auto">

            <form class="" action="" method="post">
                <div class="form-group pt-3">
                  <label for="name">Nume </label>
                  <input type="text" name="name"  class="form-control" placeholder="Introduceți numele">
                </div>
                <div class="form-group">
                  <label for="username">Prenume</label>
                  <input type="text" name="username"  class="form-control" placeholder="Introduceți prenumele">
                </div>
                <div class="form-group">
                  <label for="email">Adresa email</label>
                  <input type="email" name="email"  class="form-control" placeholder="Introduceți adresa de email">
                </div>
                <div class="form-group">
                  <label for="mobile">Număr telefon</label>
                  <input type="text" name="mobile"  class="form-control" placeholder="Introduceți numărul de telefon">
                </div>
                <div class="form-group">
                  <label for="password">Parola</label>
                  <input type="password" name="password" class="form-control" placeholder="Introduceți parola">
                </div>
                <div class="form-group">
                  <div class="form-group">
                    <label for="sel1">Selectați rolul utilizatorului</label>
                    <select class="form-control" name="roleid" id="roleid">
                      <option value="1">Admin</option>
                      <option value="2">Editor</option>
                      <option value="3">Utilizator</option>

                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" name="addUser" class="btn btn-success" style="background-color: #07c5f8">Registrare</button>
                </div>


            </form>
          </div>


        </div>
      </div>

<?php
}else{

  header('Location:../Admin/index.php');



}
 ?>

  <?php
  include '../inc/footer.php';

  ?>
