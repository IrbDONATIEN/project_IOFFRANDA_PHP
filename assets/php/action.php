<?php

    session_start();
    require_once 'admina.php';
    $admin=new Admin();
   
    //Gérer l'authentification de l'utilisateur Login Admin Ajax Request
    if(isset($_POST['action'])&& $_POST['action']=='login'){

        $username=$admin->test_input($_POST['username']);
        $password=$admin->test_input($_POST['password']);
        
        $loggedInAdmin=$admin->admin_login($username,$password);

        if($loggedInAdmin !=null){
            $_SESSION['username']=$username;
        }
        else{
            echo $admin->showMessage('danger', 'Login Et Mot de passe invalide !');
        }
        
    }

    //Gérer l'authentification de l'utilisateur  Login Ajax Request
    if(isset($_POST['action'])&& $_POST['action']=='loginUs'){

        $login_user=$admin->test_input($_POST['login_user']);
        $motdepasse=$admin->test_input($_POST['motdepasse']);
        $typeService=$admin->test_input($_POST['typeService']);
        $loggedInUser=$admin->user_login($login_user,$motdepasse,$typeService);

        if($loggedInUser !=null){
            $_SESSION['login_user']=$login_user;
        }
        else{
            echo $admin->showMessage('danger', 'Login, Mot de passe, Service invalide !');
        }
    }


?>