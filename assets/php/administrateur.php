<?php
    require_once 'header.php';
    require_once 'admina.php';
    $count=new Admin();
?>
<div class="container mt-1">
    <div class="mt-1">
            <img src="../images/logo.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/logo.png">
    </div>
    <hr class="bg-primary">
    <div class="alert alert-info bg-primary alert-dismissible text-center text-white mt-2 m-0">
        <div class="col-lg-16">
            <strong>Bienvenu(e) dans le système d'administration de gestion d'offrande iOffranda</strong>
        </div>
    </div>
    <div class="row text-center ">
    <div class="col-lg-12">
        <div class="card-deck mt-3 text-light text-center font-weight-bold">
            <!--Debut de la case 1-->
            <div class="card bg-primary">
                <div class="card-header"><i class="fa fa-university" aria-hidden="true"></i>&nbsp;&nbsp;Total Eglise</div>
                    <div class="card-body">
                        <h1 class="display-4">
                           <?= $count->totalCount('eglise');?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-secondary">
                <div class="card-header"><i class="fa fa-user"></i>&nbsp;&nbsp;Total Utilisateur</div>
                    <div class="card-body">
                        <h1 class="display-4">
                           <?= $count->totalCount('utilisateurs');?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-info">
                <div class="card-header"><i class="fa fa-business-time"></i>&nbsp;&nbsp;Total Service</div>
                    <div class="card-body">
                        <h1 class="display-4">
                           <?= $count->totalCount('service');?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-warning">
                <div class="card-header"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;Total Rapport</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            <?= $count->totalCount('rapport');?>
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
                <div class="card-header"><i class="fas fa-money-check-alt"></i>&nbsp;Total Offrande</div>
                    <div class="card-body">
                        <h1 class="display-4">
                           <?php  $data=$count->offrandeTotalGenerals(); echo $data['Montants'];?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-success">
                <div class="card-header"><i class="far fa-address-book"></i>&nbsp;Total Depense</div>
                    <div class="card-body">
                        <h1 class="display-4">
                           <?php  $data=$count->depenseTotalGenerals(); echo $data['Montant'];?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
             <!--Debut de la case 1-->
             <div class="card bg-danger">
                <div class="card-header"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;Total Demande Non Exécutée</div>
                    <div class="card-body">
                        <h1 class="display-4">
                           <?= $count->totalDemandeNonExec();?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-primary">
                <div class="card-header"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;Total Demande Exécutée</div>
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
</div>
<?php
    require_once 'footer.php';
?>
</body>
</html>