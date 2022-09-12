<?php
    require_once 'sessionUs.php';
    if(!isset($_SESSION['login_user'])){
        header('location:utilisateur.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="fr">
    
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Ir Donatien">
        <meta http-equiv="x-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width-device-width, initial-scale=1, shrink-to-fit=no">
        <title>IOFFRANDA|<?=ucfirst(basename($_SERVER['PHP_SELF'],'.php')); ?></title>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
        <style type="text/css">
            @import url("https://fonts.googleapis.com/css?family=Maven+Pro:400,500,600,700,800,900&display=swap");
            *{
                font-family:'Maven Pro', sans-serif;
                font-size:18px;
            }
                       
            /*FOOTER*/
            .footer{
            background:#303022;
            color:#d3d3d3;
            height: 70px;
            position: relative;
            }

             /* Make the image fully responsive */
            .carousel-inner {
                width: 100%;
                height: 100%;
            }
            .footer .footer-botton{
            background:#343a40;
            color:#686868;
            height: 70px;
            width: 100%;
            border:1px solid red;
            text-align:center;
            position:absolute;
            bottom:0px;
            left: 0px;
            padding-top:20px;
            }
        </style>
        <link rel="shortcut icon" href="../images/logo.png" />
    </head>
    <body class="bg-white">

    <nav class="navbar navbar-expand-md bg-info navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="offrandes.php"><img src="../images/logo.png" style="width: 20%;height: 20%;" class="rounded-circle" >&nbsp;<strong>IOFFRANDA</strong></a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link <?=(basename($_SERVER['PHP_SELF'])=="offrandes.php")?"active":"";?>" href="offrandes.php"><i class="fa fa-home"></i>&nbsp;Accueil</a>
                </li>
                <?php if($cservice=='FINANCE'):?>
                <li class="nav-item">
                    <a class="nav-link <?=(basename($_SERVER['PHP_SELF'])=="offrande.php")?"active":"";?>" href="offrande.php"><i class="fas fa-money-check-alt"></i>&nbsp;Offrandes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=(basename($_SERVER['PHP_SELF'])=="depotoffrande.php")?"active":"";?>" href="depotoffrande.php"><i class="fa fa-folder"></i>&nbsp;<i class="fa fa-folder"></i>&nbsp;Dépôt Offrandes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=(basename($_SERVER['PHP_SELF'])=="garderoffrande.php")?"active":"";?>" href="garderoffrande.php"><i class="fa fa-folder"></i>&nbsp;Garder Offrandes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=(basename($_SERVER['PHP_SELF'])=="depense.php")?"active":"";?>" href="depense.php"><i class="fas fa-business-time"></i>&nbsp;Depenses</a>
                </li>
                <?php endif;?>
                <?php if($cservice=='TRESORERIE'):?>
                <li class="nav-item">
                    <a class="nav-link <?=(basename($_SERVER['PHP_SELF'])=="garderoffrande.php")?"active":"";?>" href="garderoffrande.php"><i class="fa fa-folder"></i>&nbsp;Garder Offrandes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=(basename($_SERVER['PHP_SELF'])=="depense.php")?"active":"";?>" href="depense.php"><i class="fas fa-business-time"></i>&nbsp;Depenses</a>
                </li>
                <?php endif;?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown" href="#">
                        <i class="fas fa-user-cog"></i>&nbsp;Salut!<?=$clogin_user;?>
                    </a>
                    <div class="dropdown-menu">
                        <?php if($cservice=='FINANCE'):?>
                            <a href="demande.php" class="dropdown-item <?=(basename($_SERVER['PHP_SELF'])=="demande.php")?"active":"";?>"><i class="fa fa-pen"></i>&nbsp;Ecrire Demande</a>
                            <a href="rapport.php" class="dropdown-item <?=(basename($_SERVER['PHP_SELF'])=="rapport.php")?"active":"";?>"><i class="fa fa-book"></i>&nbsp;Rapport</a>
                        <?php endif;?>
                            <a href="logout.php" class="dropdown-item"> <i class="fas fa-sign-out-alt"></i>&nbsp;Déconnexion</a>
                    </div>
                </li>
                </ul>
            </div> 
        </nav>