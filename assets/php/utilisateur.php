<?php
    session_start();
    require_once 'headerUser.php';
    require_once 'connexion.php';
    if(isset($_POST['login_user'])){
      header('location:utilisateur.php');
      exit();
    }
?>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-6 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo" style="width: 200px;height: 100px;">
                <img src="../images/logo.png" style="width: 100%;height: 100%;object-fit: scale-down;position: relative;left: 70%;">
              </div>
              <div class="card-header bg-info">
                <h3 class="m-0 text-white"><i class="fas fa-user"></i>&nbsp;IOFFRANDA|UTILISATEUR</h3>
              </div>
              <form class="pt-3" action="#" id="login-form" method="post">
                <div id="LoginAlert"></div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="login_user" name="login_user" placeholder="Votre login utilisateur" required autofocus>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="motdepasse" name="motdepasse" placeholder="Votre mot de passe utilisateur" required>
                </div>
                <div class="form-group">
                      <label for="typeService">Sélectionner Service:</label>
                      <select name="typeService" id="typeService" class="form-control  form-control-lg" required>
                            <?php $req=$db->query("SELECT * FROM service");
                                  while ($tab=$req->fetch()){?>
                                     <option value="<?php echo $tab['idService'];?>"><?php echo $tab['Service'];?></option>
                            <?php
                                }
                            ?>
                      </select>
                </div>
                <div class="form-group">
                    <input type="submit" name="valider" class="btn btn-info btn-block btn-lg" value="Se connecter" id="LoginBtn" required>
                </div>
                <div>
                  <a href="admin.php">Admin</a>
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
      $("#LoginBtn").click(function(e){
            if($("#login-form")[0].checkValidity()){
              e.preventDefault();
              $(this).val('Veuillez patientier...');
              $.ajax({
                  url : 'action.php',
                  method : 'post',
                  data : $("#login-form").serialize()+'&action=loginUs',
                  success:function(response){
                    if(response === 'loginUs'){
                          window.location = 'offrandes.php';
                      }
                      else{
                          $("#LoginAlert").html(response);
                      }
                      window.location = 'offrandes.php';
                      $("#LoginBtn").val('Se connecter');
                  }
              });
            }
        });
    });
</script>
</body>
</html>