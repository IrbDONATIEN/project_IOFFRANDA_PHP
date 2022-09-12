<?php
    session_start();
    require_once 'headerUser.php';
    if(isset($_POST['username'])){
      header('location:administrateur.php');
      exit();
  }
?>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-6 mx-auto">
            <div class="auth-form-light text-left p-5">
              <hr>
              <div class="card-header bg-info">
                <h3 class="m-0 text-white"><i class="fas fa-user"></i>&nbsp;IOFFRANDA|ADMIN</h3>
              </div>
              <form class="pt-3" action="#" id="login-form" method="post">
                <div id="adminLoginAlert"></div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Votre login administrateur" required autofocus>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Votre mot de passe administrateur" required>
                </div>
                <div class="form-group">
                    <input type="submit" name="valider" class="btn btn-info btn-block btn-lg" value="Se connecter" id="LoginAdminBtn" required>
                </div>
                <div class="align-items-center">
                  <a href="utilisateur.php">Utilisateur</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
    require_once 'footer.php';
  ?>
  <script type="text/javascript">
    $(document).ready(function(){
        $("#LoginAdminBtn").click(function(e){
            if($("#login-form")[0].checkValidity()){
              e.preventDefault();
              $(this).val('Veuillez patientier...');
              $.ajax({
                  url : 'action.php',
                  method : 'post',
                  data : $("#login-form").serialize()+'&action=login',
                  success:function(response){
                     if(response === 'admin_login'){
                          window.location = 'administrateur.php';
                      }
                      else{
                          $("#adminLoginAlert").html(response);
                      }
                      window.location = 'administrateur.php';
                      $("#LoginAdminBtn").val('Se connecter');
                  }
              });
            }
        });
    });
 </script>
</body>
</html>