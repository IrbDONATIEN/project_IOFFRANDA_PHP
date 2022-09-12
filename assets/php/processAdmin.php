<?php
     require_once 'admina.php';
     $admin=new Admin();

     require_once 'users.php';
     $users=new Users();

    //Gérer la creation de l'Eglise Ajax Request
    if(isset($_POST['action'])&& $_POST['action']=='createChurch'){
        $eglise=$admin->test_input($_POST['eglise']);
        if($admin->eglise_existe($eglise)){
            echo $admin->showMessage('warning', 'Cette eglise est déjà utilisée et Veuillez choisir une autre svp! ');
        }
        else
        {
            if($admin->eglise($eglise))
            {
            }else{
                echo $admin->showMessage('danger', 'Un problème est survenu! Réessayez plus tard.');
            }
        }
    }

     //Gérer la requête Afficher toutes les eglises en Ajax Request
     if(isset($_POST['action']) && $_POST['action']=='afficherEglises'){
        $output='';
        $eglises=$admin->afficherEglises();
        if($eglises){
            $output .='
                <table class="table table-striped table-sm table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Code Eglise</th>
                            <th>Nom Eglise</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($eglises as $row){
                        $output .='<tr>
                                        <td>'.$row['idEglise'].'</td>
                                        <td>'.$row['eglise'].'</td>
                                        <td>
                                            <a href="#" id="'.$row['idEglise'].'" title="Afficher Détail Eglise" class="text-success infoEgliseBtn"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;

                                            <a href="#" id="'.$row['idEglise'].'" title="Editer Eglise" class="text-primary editEgliseBtn" data-toggle="modal" data-target="#EditEgliseModal"><i class="fas fa-edit fa-lg"></i></a>&nbsp;

                                            <a href="#" id="'.$row['idEglise'].'" title="Supprimer une Eglise" class="text-danger deleteEgliseIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
                                        </td>
                                   </tr>';
                    }
                    $output .='
                    </tbody>
                    </table>';
                    echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary">:( Pas encore d\'eglises enregistrées ici !</h3>';
        }
     }

    //Gérer supprimer l'eglise en  Ajax Request
    if(isset($_POST['supprimer_eglise'])){
        $id=$_POST['supprimer_eglise'];
        $admin->deleteEglise($id);
    }

     //Gérer la requête d'affichage pour l'édition des eglises avec Ajax
     if(isset($_POST['editeglise_id'])){
    
        $id=$_POST['editeglise_id'];
        $row=$admin->editereglise($id);
        echo json_encode($row);

    }

    //Gérer update de l'Eglise Ajax Request
    if(isset($_POST['action'])&& $_POST['action']=='update_eglise'){
        $id=$admin->test_input($_POST['idEglise']);
        $eglise=$admin->test_input($_POST['Eglise']);
        if($admin->eglise_existe($eglise)){
            echo $admin->showMessage('warning', 'Cette eglise est déjà utilisée et Veuillez choisir une autre svp! ');
        }
        else
        {
            if($admin->update_eglise($id,$eglise))
            {
            }else{
                echo $admin->showMessage('danger', 'Un problème est survenu! Réessayez plus tard.');
            }
        }
    }
    
    //Gérer l'affichage d'une eglise sélectionnée avec Ajax Request
    if(isset($_POST['infoeglise_id'])){
        $id=$_POST['infoeglise_id'];
        
        $row=$admin->editereglise($id);
        echo json_encode($row);
    }

    //GESTION DES SERVICES POUR LES EGLISES
    //Gérer la creation de service Ajax Request
        if(isset($_POST['action'])&& $_POST['action']=='createService'){
            $service=$admin->test_input($_POST['Service']);
            $EgliseId=$admin->test_input($_POST['EgliseId']);
            if($admin->service_exist($service)){
                echo $admin->showMessage('warning', 'Ce service est déjà utilisé et Veuillez choisir un autre svp! ');
            }
            else
            {
                if($admin->service($service,$EgliseId))
                {
                }else{
                    echo $admin->showMessage('danger', 'Un problème est survenu! Réessayez plus tard.');
                }
            }
        }
    
         //Gérer la requête Afficher tous les services en Ajax Request
         if(isset($_POST['action']) && $_POST['action']=='afficherServices'){
            $output='';
            $service=$admin->afficherServices();
            if($service){
                $output .='
                    <table class="table table-striped table-sm table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Code Service</th>
                                <th>Nom Service</th>
                                <th>Eglise</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach($service as $row){
                            $output .='<tr>
                                            <td>'.$row['idService'].'</td>
                                            <td>'.$row['Service'].'</td>
                                            <td>'.$row['Eglise'].'</td>
                                            <td>
                                                <a href="#" id="'.$row['idService'].'" title="Afficher Détail Service" class="text-success infoServiceBtn"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;
    
                                                <a href="#" id="'.$row['idService'].'" title="Editer Service" class="text-primary editServiceBtn" data-toggle="modal" data-target="#EditServiceModal"><i class="fas fa-edit fa-lg"></i></a>&nbsp;
    
                                                <a href="#" id="'.$row['idService'].'" title="Supprimer un Service" class="text-danger deleteServiceIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
                                            </td>
                                       </tr>';
                        }
                        $output .='
                        </tbody>
                        </table>';
                        echo $output;
            }
            else{
                echo '<h3 class="text-center text-secondary">:( Pas encore des services enregistrés ici !</h3>';
            }
         }
    
        //Gérer supprimer le service en  Ajax Request
        if(isset($_POST['supprimer_service'])){
            $id=$_POST['supprimer_service'];
            $admin->deleteService($id);
        }
    
         //Gérer la requête d'affichage pour l'édition des services avec Ajax
         if(isset($_POST['editservice_id'])){
        
            $id=$_POST['editservice_id'];
            $row=$admin->editerservice($id);
            echo json_encode($row);
        }
    
        //Gérer update de service Ajax Request
        if(isset($_POST['action'])&& $_POST['action']=='update_service'){
            $id=$admin->test_input($_POST['idService']);
            $service=$admin->test_input($_POST['Service']);
            $EgliseId=$admin->test_input($_POST['EgliseId']);
            if($admin->service_exist($service)){
                echo $admin->showMessage('warning', 'Ce Service est déjà utilisé et Veuillez choisir un autre svp! ');
            }
            else
            {
                if($admin->update_service($id,$service,$EgliseId))
                {
                }else{
                    echo $admin->showMessage('danger', 'Un problème est survenu! Réessayez plus tard.');
                }
            }
        }
        
        //Gérer l'affichage d'un service sélectionné avec Ajax Request
        if(isset($_POST['infoservice_id'])){
            $id=$_POST['infoservice_id'];
            
            $row=$admin->editerservices($id);
            echo json_encode($row);
        }

        //GESTION DES UTILISATEURS DE L'APPLICATION
         //Gérer la creation de l'utilisateur Ajax Request
         if(isset($_POST['action'])&& $_POST['action']=='createUtilisateur'){
             
            $nom=$users->test_input($_POST['nom']);
            $postnom=$users->test_input($_POST['postnom']);
            $prenom=$users->test_input($_POST['prenom']);
            $sexe=$users->test_input($_POST['sexe']);
            $telephone=$users->test_input($_POST['telephone']);
            $loginUser=$users->test_input($_POST['loginUser']);
            $motdepasse=$users->test_input($_POST['motdepasse']);
            $typeService=$users->test_input($_POST['typeService']);
            if($users->utilisateur_exist($loginUser)){
                echo $users->showMessage('warning', 'Cet Login Utilisateur est déjà utilisé et Veuillez choisir un autre svp! ');
            }
            else
            {
                if($users->utilisateurs($nom,$postnom,$prenom,$sexe,$telephone,$loginUser,$motdepasse,$typeService))
                {
                }else{
                    echo $users->showMessage('danger', 'Un problème est survenu! Réessayez plus tard.');
                }
            }
        }
    
         //Gérer la requête Afficher tous les utilisateurs en Ajax Request
         if(isset($_POST['action']) && $_POST['action']=='afficherUtilisateurs'){
            $output='';
            $utilisateur=$users->afficherUtilisateurs();
            if($utilisateur){
                $output .='
                    <table class="table table-striped table-sm table-bordered text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Postnom</th>
                                <th>Prenom</th>
                                <th>Sexe</th>
                                <th>Telephone</th>
                                <th>Login</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach($utilisateur as $row){
                            $output .='<tr>
                                            <td>'.$row['id'].'</td>
                                            <td>'.$row['nom'].'</td>
                                            <td>'.$row['postnom'].'</td>
                                            <td>'.$row['prenom'].'</td>
                                            <td>'.$row['sexe'].'</td>
                                            <td>'.$row['telephone'].'</td>
                                            <td>'.$row['loginUser'].'</td>
                                            <td>
                                                <a href="#" id="'.$row['id'].'" title="Afficher Détail Utilisateur" class="text-success infoUtilisateurBtn"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;
    
                                                <a href="#" id="'.$row['id'].'" title="Editer Utilisateur" class="text-primary editUtilisateurBtn" data-toggle="modal" data-target="#EditUtilisateurModal"><i class="fas fa-edit fa-lg"></i></a>&nbsp;
    
                                                <a href="#" id="'.$row['id'].'" title="Supprimer un Utilisateur" class="text-danger deleteUtilisateurIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
                                            </td>
                                       </tr>';
                        }
                        $output .='
                        </tbody>
                        </table>';
                        echo $output;
            }
            else{
                echo '<h3 class="text-center text-secondary">:( Pas encore des Utilisateurs enregistrés ici !</h3>';
            }
         }
    
        //Gérer supprimer l'utilisateur en  Ajax Request
        if(isset($_POST['supprimer_utilisateur'])){
            $id=$_POST['supprimer_utilisateur'];
            $users->deleteUtilisateur($id);
        }
    
         //Gérer la requête d'affichage pour l'édition des utilisateurs avec Ajax
         if(isset($_POST['editutilisateur_id'])){
        
            $id=$_POST['editutilisateur_id'];
            $row=$users->editerutilisateur($id);
            echo json_encode($row);
        }
    
        //Gérer update de l'utilisateur Ajax Request
        if(isset($_POST['action'])&& $_POST['action']=='update_utilisateur'){
            $id=$users->test_input($_POST['id']);
            $nom=$users->test_input($_POST['nom']);
            $postnom=$users->test_input($_POST['postnom']);
            $prenom=$users->test_input($_POST['prenom']);
            $sexe=$users->test_input($_POST['sexe']);
            $telephone=$users->test_input($_POST['telephone']);
            $login=$users->test_input($_POST['login']);
            $motdepasse=$users->test_input($_POST['motdepasse']);
            $typeService=$users->test_input($_POST['typeService']);
            if($users->utilisateur_exist($login)){
                echo $users->showMessage('warning', 'Cet  login Utilisateur est déjà utilisé et Veuillez choisir un autre svp! ');
            }
            else
            {
                if($users->update_utilisateur($id,$nom,$postnom,$prenom,$sexe,$telephone,$login,$motdepasse,$typeService))
                {
                }else{
                    echo $users->showMessage('danger', 'Un problème est survenu! Réessayez plus tard.');
                }
            }
        }
        
        //Gérer l'affichage d'un utilisateur sélectionné avec Ajax Request
        if(isset($_POST['infoutilisateur_id'])){
            $id=$_POST['infoutilisateur_id'];
            
            $row=$users->editerutilisateurs($id);
            echo json_encode($row);
        }

        //CULTES
        //Gérer la creation de l'Eglise Ajax Request
    if(isset($_POST['action'])&& $_POST['action']=='createCulte'){
        $Culte=$admin->test_input($_POST['Culte']);
        $admin->culte($Culte);
    }

     //Gérer la requête Afficher tous les cultes en Ajax Request
     if(isset($_POST['action']) && $_POST['action']=='afficherCultes'){
        $output='';
        $cultes=$admin->afficherCultes();
        if($cultes){
            $output .='
                <table class="table table-striped table-sm table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Code Culte</th>
                            <th>Nom Culte</th>
                            <th>Date</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($cultes as $row){
                        $a=$row['etat'];
                        if($a>0){$a='Listé';}else{$a='Non Listé';}
                        $output .='<tr>
                                        <td>'.$row['idCulte'].'</td>
                                        <td>'.$row['Culte'].'</td>
                                        <td>'.$row['dateCulte'].'</td>
                                        <td>'.$a.'</td>
                                   </tr>';
                    }
                    $output .='
                    </tbody>
                    </table>';
                    echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary">:( Pas encore des Cultes enregistrés ici !</h3>';
        }
     }


           //Gérer la requête Afficher tous les rapports en Ajax Request
           if(isset($_POST['action']) && $_POST['action']=='afficherRapportOffrandes'){
            $output='';
            $rapportOffrandes=$admin->afficherRapportOffrandes();
            if($rapportOffrandes){
                $output .='
                    <table class="table table-striped table-sm table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Montant Entre</th>
                                <th>Montant Sortie</th>
                                <th>Montant Restant</th>
                                <th>Type Offrande</th>
                                <th>Mois Rapport</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach($rapportOffrandes as $row){
                            $output .='<tr>
                                            <td>'.$row['idRapport'].'</td>
                                            <td>'.$row['MontantEntre'].'</td>
                                            <td>'.$row['MontantSortie'].'</td>
                                            <td>'.$row['Reste'].'</td>
                                            <td>'.$row['Offrande_type'].'</td>
                                            <td>'.$row['dateRapport'].'</td>
                                       </tr>';
                        }
                        $output .='
                        </tbody>
                        </table>';
                        echo $output;
            }
            else{
                echo '<h3 class="text-center text-secondary">:( Pas encore des rapports Offrande déposé ici !</h3>';
            }
      }
?>