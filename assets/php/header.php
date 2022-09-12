<?php
    require_once 'session.php';
    if(!isset($_SESSION['username'])){
        header('location:admin.php');
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
        <a class="navbar-brand" href="administrateur.php"><img src="../images/logo.png" style="width: 20%;height: 20%;" class="rounded-circle" >&nbsp;<strong>IOFFRANDA</strong></a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link <?=(basename($_SERVER['PHP_SELF'])=="administrateur.php")?"active":"";?>" href="administrateur.php"><i class="fa fa-home"></i>&nbsp;Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=(basename($_SERVER['PHP_SELF'])=="rapports.php")?"active":"";?>" href="rapports.php"><i class="fa fa-book"></i>&nbsp;Rapports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=(basename($_SERVER['PHP_SELF'])=="utilisateurs.php")?"active":"";?>" href="utilisateurs.php"><i class="fa fa-user"></i>&nbsp;Utilisateurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=(basename($_SERVER['PHP_SELF'])=="cultes.php")?"active":"";?>" href="cultes.php"><i class="fa fa-pen"></i>&nbsp;Cultes</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown" href="#">
                        <i class="fas fa-user-cog"></i>&nbsp;Salut!<?=$clogin_admin;?>
                    </a>
                    <div class="dropdown-menu">
                            <a href="eglise.php" class="dropdown-item <?=(basename($_SERVER['PHP_SELF'])=="eglise.php")?"active":"";?>"><i class="fa fa-university" aria-hidden="true"></i>&nbsp;Créer Eglise</a>
                            <a href="service.php" class="dropdown-item <?=(basename($_SERVER['PHP_SELF'])=="service.php")?"active":"";?>"><i class="fas fa-business-time"></i>&nbsp;Créer Service</a>
                        <a href="logout.php" class="dropdown-item"> <i class="fas fa-sign-out-alt"></i>&nbsp;Déconnexion</a>
                    </div>
                </li>
                </ul>
            </div> 
        </nav>