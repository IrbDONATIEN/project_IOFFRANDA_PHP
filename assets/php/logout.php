<?php
    session_start();
    unset($_SESSION['login_user']);
    unset($_SESSION['username']);
    header('location:../../index.php');
?>