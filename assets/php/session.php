<?php
session_start();
require_once 'admina.php';
$cadmin=new Admin();

//Session Administrateur iOffranda
if(!isset($_SESSION['username'])){
    header('location:admin.php');
    die;
}
$clogin_admin=$_SESSION['username'];
    
    $data=$cadmin->currentAdmin($clogin_admin);

    $cid=$data['id'];
    $clogin_admin=$data['username'];

?>