<?php
    require_once 'headerUs.php';
    require_once 'userUs.php';
    $count=new UserUs();
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
    <div class="row text-center ">
    <?php if($cservice=='FINANCE'):?>
    <div class="col-lg-12">
        <div class="card-deck mt-3 text-light text-center font-weight-bold">
            <!--Debut de la case 1-->
            <div class="card bg-primary">
                <div class="card-header"><i class="fas fa-money-check-alt" aria-hidden="true"></i>&nbsp;&nbsp;Total Offrande </div>
                    <div class="card-body">
                        <h1 class="display-4">
                          <?= $count->totalCount('offrande');?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-secondary">
                <div class="card-header"><i class="fa fa-file"></i>&nbsp;&nbsp;Total Offrande Non Déposée </div>
                    <div class="card-body">
                        <h1 class="display-4">
                            <?= $count->totalOffrandeNonDeposee();?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-info">
                <div class="card-header"><i class="fa fa-folder"></i>&nbsp;<i class="fa fa-folder"></i>&nbsp;&nbsp;Total Offrande Déposée</div>
                    <div class="card-body">
                        <h1 class="display-4">
                        <?= $count->totalOffrandeDeposee();?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-warning">
                <div class="card-header"><i class="fa fa-folder" aria-hidden="true"></i>&nbsp;&nbsp;Total Offrande Gardée</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            <?= $count->totalOffrandeGardee();?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
        </div>        
    </div>
</div>
<!--Fin de la ligne 1-->
<div class="row text-center ">
    <div class="col-lg-12">
        <div class="card-deck mt-3 text-light text-center font-weight-bold">
            <!--Debut de la case 1-->
            <div class="card bg-dark">
                <div class="card-header"><i class="fas fa-book"></i>&nbsp;Total Rapport</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            <?= $count->totalrapportOffrande();?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-success">
                <div class="card-header"><i class="fa fa-business-time"></i>&nbsp;Total Depense</div>
                    <div class="card-body">
                        <h1 class="display-4">
                           <?php  $data=$count->depenseTotalGenerals(); echo $data['Montant'];?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
             <!--Debut de la case 1-->
             <div class="card bg-danger">
                <div class="card-header"><i class="fa fa-pen" aria-hidden="true"></i>&nbsp;Total Demande Non Exécutée</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            <?= $count->totalDemandeNonExec();?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-primary">
                <div class="card-header"><i class="fa fa-pen" aria-hidden="true"></i>&nbsp;Total Demande Exécutée</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            <?= $count->totalDemandeExec();?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
        </div>        
    </div>
</div>
<!--Fin de la ligne 1-->
<?php else:?>
    <h1 class="text-center text-secondary mt-5">Vous n'êtes autorisé à voir les contenues de cette page !</h1>
<?php endif;?>
</div>
<?php
    require_once 'footer.php';
?>
</body>
</html>