<?php
session_start();
require_once 'admina.php';
$cadmin=new Admin();

//Session Utilisateur iOffranda
if(!isset($_SESSION['login_user'])){
    header('location:utilisateur.php');
    die;
}
$clogin_user=$_SESSION['login_user'];
    
    $data=$cadmin->currentUser($clogin_user);

    $cuid=$data['id'];
    $clogin_user=$data['loginUser'];
    $cnom=$data['nom'];
    $cpostnom=$data['postnom'];
    $cprenom=$data['prenom'];
    $cservice=$data['Service'];
    $ctypeService=$data['typeService'];

    if($ctypeService==1){
        $cservice='FINANCE';
    }
    else
    { 
        $cservice='TRESORERIE';
    }
?>