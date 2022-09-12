<?php
     require_once 'userUs.php';
     require_once 'sessionUs.php';
     $user=new UserUs();
     
     $mois=(int)(date("m"));
     $annee=(int)(date("Y"));
     if($mois>=1)
     {
        $daterapport='0'.$mois.'-'.$annee;
     }
     else if($mois>=2)
     {
        $daterapport='0'.$mois.'-'.$annee;
     }
     else if($mois>=3)
     {
        $daterapport='0'.$mois.'-'.$annee;
     }
     else if($mois>=4)
     {
        $daterapport='0'.$mois.'-'.$annee;
     }
     else if($mois>=5)
     {
        $daterapport='0'.$mois.'-'.$annee;
     }
     else if($mois>=6)
     {
        $daterapport='0'.$mois.'-'.$annee;
     }
     else if($mois>=7)
     {
        $daterapport='0'.$mois.'-'.$annee;
     }
     else if($mois>=8)
     {
        $daterapport='0'.$mois.'-'.$annee;
     }
     else if($mois>=9)
     {
        $daterapport='0'.$mois.'-'.$annee;
     }
     else
     {
        $daterapport=$mois.'-'.$annee;
     }

     //GESTION DES offrandes DE L'APPLICATION
     //Gérer la creation de l'offrande Ajax Request
     if(isset($_POST['action'])&& $_POST['action']=='createOffrande'){
          $montantOffrande=$user->test_input($_POST['montantOffrande']);
          $typeOffrande=$user->test_input($_POST['typeOffrande']);
          $CulteId=$user->test_input($_POST['CulteId']);
        
        $user->offrande($typeOffrande,$montantOffrande,$CulteId);
        $user->rapport($typeOffrande,$montantOffrande,$daterapport);
        $user->update_culte($CulteId);
     }
     
    //Gérer depot de l'offrande Ajax Request
    if(isset($_POST['action'])&& $_POST['action']=='depotOffrande'){
        $depot=$user->test_input($_POST['depot']);
        $idOffrande=$user->test_input($_POST['idOffrande']);
        $user->depot_offrande($idOffrande,$depot);
    }

     //Gérer Ecriture demande depense Ajax Request
     if(isset($_POST['action'])&& $_POST['action']=='demandeOffrande'){
        $motifDemande=$user->test_input($_POST['motifDemande']);
        $Description=$user->test_input($_POST['Description']);
        $user->add_demande($Description,$motifDemande,$ctypeService);
    }

     //Gérer Edition demande depense Ajax Request
     if(isset($_POST['action'])&& $_POST['action']=='update_demande'){
        $id=$user->test_input($_POST['id']);
        $motifDemande=$user->test_input($_POST['motifDemande']);
        $Description=$user->test_input($_POST['Description']);
        $user->update_demande($id,$Description,$motifDemande,$ctypeService);
    }

     //Gérer depot de l'offrande Ajax Request
     if(isset($_POST['action'])&& $_POST['action']=='garderOffrande'){
        $garder=$user->test_input($_POST['garder']);
        $idOffrande=$user->test_input($_POST['idOffrande']);
        $user->garder_offrande($idOffrande,$garder);
    }

     //Gérer l'edition d'offrande Ajax Request
     if(isset($_POST['action'])&& $_POST['action']=='update_offrande'){
        $id=$user->test_input($_POST['id']);
        $typeOffrande=$user->test_input($_POST['typeOffrande']);
        $montantOffrande=$user->test_input($_POST['montantOffrande']);
        $CulteId=$user->test_input($_POST['CulteId']);
        $user->update_offrande($id,$typeOffrande,$montantOffrande,$CulteId);
     }

     //Gérer la creation de depense l'offrande Ajax Request
     if(isset($_POST['action'])&& $_POST['action']=='createdepenseOffrande'){
        $destineDepense=$user->test_input($_POST['destineDepense']);
        $motifDepense=$user->test_input($_POST['motifDepense']);
        $montantDepense=$user->test_input($_POST['montantDepense']);
        $idOffrande=$user->test_input($_POST['idOffrande']);
        $DemandeId=$user->test_input($_POST['DemandeId']);
        $idRapport=$user->test_input($_POST['idRapport']);
        $user->add_depense($destineDepense,$motifDepense,$montantDepense,$DemandeId);
        $user->update_demandeExec($DemandeId);
        $user->update_rapport($idRapport,$montantDepense);
        $user->update_SoustrationOffrande($idOffrande,$montantDepense);
        
     }

     //Gérer la requête Afficher tous les offrandes en Ajax Request
     if(isset($_POST['action']) && $_POST['action']=='afficherDemandes'){
          $output='';
          $Demandes=$user->afficherDemandes();
          if($Demandes){
              $output .='
                  <table class="table table-striped table-sm table-bordered text-center">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Motif</th>
                              <th>Description</th>
                              <th>Service</th>
                              <th>Operation</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>';
                      foreach($Demandes as $row){
                          $d=$row['demandeExec'];
                          if($d>0){ $d='Exécutée';}else{$d='Non Exécutée';}
                          $output .='<tr>
                                          <td>'.$row['idDemande'].'</td>
                                          <td>'.$row['motifDemande'].'</td>
                                          <td>'.substr($row['Description'],0,30).'...</td>
                                          <td>'.$row['Service'].'</td>
                                          <td>'.$d.'</td>
                                          <td>
                                              <a href="#" id="'.$row['idDemande'].'" title="Afficher Détail Demande depense" class="text-success infodemandeBtn"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;
  
                                              <a href="#" id="'.$row['idDemande'].'" title="Editer Demande depense" class="text-primary editDemandeBtn" data-toggle="modal" data-target="#EditDemandesModal"><i class="fas fa-edit fa-lg"></i></a>&nbsp;
  
                                              <a href="#" id="'.$row['idDemande'].'" title="Supprimer une demande depense" class="text-danger deleteDemandeIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
                                          </td>
                                     </tr>';
                      }
                      $output .='
                      </tbody>
                      </table>';
                      echo $output;
          }
          else{
              echo '<h3 class="text-center text-secondary">:( Pas encore des Demandes de depenses enregistrées ici !</h3>';
          }
    }

     //Gérer la requête Afficher tous les demandes en Ajax Request
     if(isset($_POST['action']) && $_POST['action']=='afficherOffrandes'){
        $output='';
        $Offrandes=$user->afficherOffrandes();
        if($Offrandes){
            $output .='
                <table class="table table-striped table-sm table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Type</th>
                            <th>Montant</th>
                            <th>Date Culte</th>
                            <th>Operation</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($Offrandes as $row){
                        $a=$row['depot'];
                        if($a>0){$a='Déposée';}else{$a='Non Déposée';}
                        $output .='<tr>
                                        <td>'.$row['idOffrande'].'</td>
                                        <td>'.$row['typeOffrande'].'</td>
                                        <td>'.$row['montantOffrande'].'</td>
                                        <td>'.$row['Datee'].'</td>
                                        <td>'.$a.'</td>
                                        <td>
                                            <a href="#" id="'.$row['idOffrande'].'" title="Afficher Détail Offrande" class="text-success infooffrandeBtn"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;

                                            <a href="#" id="'.$row['idOffrande'].'" title="Editer Offrande" class="text-primary editOffrandeBtn" data-toggle="modal" data-target="#EditOffrandeModal"><i class="fas fa-edit fa-lg"></i></a>&nbsp;

                                            <a href="#" id="'.$row['idOffrande'].'" title="Supprimer une Offrande" class="text-danger deleteOffrandeIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
                                        </td>
                                   </tr>';
                    }
                    $output .='
                    </tbody>
                    </table>';
                    echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary">:( Pas encore des demandes de depenses enregistrées ici !</h3>';
        }
  }


    //Gérer la requête Afficher tous les depots en Ajax Request
    if(isset($_POST['action']) && $_POST['action']=='afficherdepotOffrandes'){
        $output='';
        $Offrandes=$user->afficherdepotOffrandes();
        if($Offrandes){
            $output .='
                <table class="table table-striped table-sm table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Type Offrande</th>
                            <th>Montant Offrandes</th>
                            <th>Date Culte</th>
                            <th>Depot</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($Offrandes as $row){
                        $d=$row['depot'];
                        if($d>0){ $d='Déposée';}else{$d='Non Déposée';}
                        $output .='<tr>
                                        <td>'.$row['idOffrande'].'</td>
                                        <td>'.$row['typeOffrande'].'</td>
                                        <td>'.$row['montantOffrande'].'</td>
                                        <td>'.$row['Datee'].'</td>
                                        <td>'.$d.'</td>
                                   </tr>';
                    }
                    $output .='
                    </tbody>
                    </table>';
                    echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary">:( Pas encore des Offrandes déposées ici !</h3>';
        }
  }


      //Gérer la requête Afficher tous les rapports en Ajax Request
      if(isset($_POST['action']) && $_POST['action']=='afficherRapportOffrandes'){
        $output='';
        $rapportOffrandes=$user->afficherRapportOffrandes();
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

      //Gérer la requête Afficher tous les Offrandes gardees en Ajax Request
      if(isset($_POST['action']) && $_POST['action']=='affichergarderOffrandes'){
        $output='';
        $Offrandes=$user->affichergarderOffrandes();
        if($Offrandes){
            $output .='
                <table class="table table-striped table-sm table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Type</th>
                            <th>Montant</th>
                            <th>Date Culte</th>
                            <th>Operation</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($Offrandes as $row){
                        $d=$row['garder'];
                        if($d>0){ $d='Gardée';}else{$d='Non Gardée';}
                        $output .='<tr>
                                        <td>'.$row['idOffrande'].'</td>
                                        <td>'.$row['typeOffrande'].'</td>
                                        <td>'.$row['montantOffrande'].'</td>
                                        <td>'.$row['Datee'].'</td>
                                        <td>'.$d.'</td>
                                        <td>
                                            <a href="#" id="'.$row['idOffrande'].'" title="Afficher Détail Offrande" class="text-success infooffrandeBtn"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;
                                        </td>
                                   </tr>';
                    }
                    $output .='
                    </tbody>
                    </table>';
                    echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary">:( Pas encore des Offrandes gardées ici !</h3>';
        }
  }

        //Gérer la requête Afficher toutes les depenses les Offrandes en Ajax Request
        if(isset($_POST['action']) && $_POST['action']=='afficherdepenseOffrandes'){
            $output='';
            $depenseOffrandes=$user->afficherdepenseOffrandes();
            if($depenseOffrandes){
                $output .='
                    <table class="table table-striped table-sm table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Destiné Depense</th>
                                <th>Motif Depense</th>
                                <th>Montant Depense</th>
                                <th>Date Depense</th>
                                <th>Service</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach($depenseOffrandes as $row){
                            $output .='<tr>
                                            <td>'.$row['idDepense'].'</td>
                                            <td>'.$row['destineDepense'].'</td>
                                            <td>'.$row['motifDepense'].'</td>
                                            <td>'.$row['montantDepense'].'</td>
                                            <td>'.$row['dateDepense'].'</td>
                                            <td>'.$row['Services'].'</td>
                                       </tr>';
                        }
                        $output .='
                        </tbody>
                        </table>';
                        echo $output;
            }
            else{
                echo '<h3 class="text-center text-secondary">:( Pas encore des depenses Offrandes réalisées ici !</h3>';
            }
      }

    //Gérer l'affichage d'une offrande sélectionnée avec Ajax Request
    if(isset($_POST['infooffrande_id'])){
        $id=$_POST['infooffrande_id'];
        
        $row=$user->editeroffrandes($id);
        echo json_encode($row);
    }

    //Gérer l'affichage d'une demande de depense sélectionnée avec Ajax Request
    if(isset($_POST['infodemande_id'])){
        $id=$_POST['infodemande_id'];
        
        $row=$user->editerdemandes($id);
        echo json_encode($row);
    }

    //Gérer l'affichage d'une demande de depense sélectionnée avec Ajax Request
    if(isset($_POST['editdemande_id'])){
        $id=$_POST['editdemande_id'];
        
        $row=$user->editerdemande($id);
        echo json_encode($row);
    }

     //Gérer l'edition d'une offrande sélectionnée avec Ajax Request
     if(isset($_POST['editoffrande_id'])){
        $id=$_POST['editoffrande_id'];
        
        $row=$user->editeroffrande($id);
        echo json_encode($row);
    }

    //Gérer supprimer l'offrande en  Ajax Request
    if(isset($_POST['supprimer_offrande'])){
        $id=$_POST['supprimer_offrande'];
        $user->deleteOffrande($id);
    }

    //Gérer supprimer demande depense en  Ajax Request
    if(isset($_POST['supprimer_demande'])){
        $id=$_POST['supprimer_demande'];
        $user->deleteDemande($id);
    }

?>