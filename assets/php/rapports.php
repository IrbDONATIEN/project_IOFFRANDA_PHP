<?php
     require_once 'header.php';
     require_once 'connexion.php';
?>
<div class="container mt-1">
    <div class="mt-1">
            <img src="../images/logo.png">
    </div>
    <div class="card border-info mt-1">
          <h5 class="card-header bg-info d-flex justify-content-between">
            <span class="text-light lead align-self-center"><i class="fa fa-book"></i>&nbsp;Tous les rapports Offrandes</span>
          </h5>
    <div class="card-body">
        <div class="table-responsive" id="afficherRapportOffrandes">
            <p class="text-center lead mt-5">Veuillez patienter...</p>
        </div>
    </div>
    </div>
<?php
    require_once 'footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){

         //Fetch All Rapports Ajax Request
         afficherRapportOffrandes();

        function afficherRapportOffrandes(){
            $.ajax({
                url:'processAdmin.php',
                method: 'post',
                data:{action: 'afficherRapportOffrandes'},
                success:function(response){
                    $("#afficherRapportOffrandes").html(response);
                    $("table").DataTable({
                        order:[0, 'desc']
                    });
                }
            });
        }


    });
</script>
</body>
</html>