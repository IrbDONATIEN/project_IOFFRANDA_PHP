<?php
    require_once 'headerUs.php';
?>
<div class="container mt-1">
    <div class="mt-1">
            <img src="../images/logo.png">
    </div>
    <hr class="bg-primary">
    <div class="alert alert-info bg-success alert-dismissible text-center text-white mt-2 m-0">
        <div class="col-lg-16">
            <strong>Bienvenu(e) dans le système d'Utilisateur de gestion d'offrande iOffranda | Service:<?= $cservice ;?> | Nom:<?= $cnom ;?></strong>
        </div>
    </div>
    <div class="card border-info mt-1">
          <h5 class="card-header bg-info d-flex justify-content-between">
            <span class="text-light lead align-self-center"><i class="fa fa-folder"></i>&nbsp;<i class="fa fa-folder"></i>&nbsp;Toutes les Offrandes Déposées</span>
          </h5>
    <div class="card-body">
        <div class="table-responsive" id="afficherdepotOffrandes">
            <p class="text-center lead mt-5">Veuillez patienter...</p>
        </div>
    </div>
</div>
<?php
    require_once 'footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){
        //Fetch All depot Ajax Request
        afficherdepotOffrandes();

        function afficherdepotOffrandes(){
            $.ajax({
                url:'processUser.php',
                method: 'post',
                data:{action: 'afficherdepotOffrandes'},
                success:function(response){
                    $("#afficherdepotOffrandes").html(response);
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