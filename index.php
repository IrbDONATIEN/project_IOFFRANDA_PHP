<!DOCTYPE html>
<html lang="fr">
    
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Ir Donatien">
        <meta http-equiv="x-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width-device-width, initial-scale=1, shrink-to-fit=no">
        <title>IOFFRANDA</title>
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
        <link rel="shortcut icon" href="assets/images/logo.png" />
    </head>
<body class="bg-beige">
<nav class="navbar navbar-expand-md bg-info navbar-dark">
            <!-- Brand -->
            <a class="navbar-brand" href=""><img src="assets/images/logo.png" style="width: 20%;height: 20%;" class="rounded-circle" >&nbsp;<strong>IOFFRANDA</strong></a>
</nav>
<div class="container mt-2">
    <div class="mt-2">
            <a href="assets/php/utilisateur.php"> <img src="assets/images/logo.png"  style="width: 100%;height: 100%;object-fit: scale-down;position: relative;"></a>
    </div>
<div>
<?php
    require_once 'assets/php/footer.php';
?>
</body>
</html>