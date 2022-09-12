<?php
    require_once 'config.php';

    class UserUs extends Database{
        //Enregistrer une offrande
        public function offrande($typeOffrande,$montantOffrande,$CulteId){
            $sql="INSERT INTO `offrande`(typeOffrande,montantOffrande,dateOffrande,CulteId) VALUES (:typeOffrande,:montantOffrande,NOW(),:CulteId)"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['typeOffrande'=>$typeOffrande,'montantOffrande'=>$montantOffrande,'CulteId'=>$CulteId]);
            return true;
        }

        //Enregistrer un rapport 
        public function rapport($typeOffrande,$Entree,$dateRapport){
            $sql="INSERT INTO `rapport`(`Entree`,`Offrande_type`, `dateRapport`) VALUES (:Entree,:Offrande_type,:dateRapport)"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['Offrande_type'=>$typeOffrande,'Entree'=>$Entree,'dateRapport'=>$dateRapport]);
            return true;
        }

        //Enregistrer une depense 
        public function add_depense($destineDepense,$motifDepense,$montantDepense,$DemandeId){
            $sql="INSERT INTO `depense`(`destineDepense`, `motifDepense`, `montantDepense`, `dateDepense`, `DemandeId`) VALUES (:destineDepense,:motifDepense,:montantDepense,NOW(),:DemandeId)"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['destineDepense'=>$destineDepense,'motifDepense'=>$motifDepense,'montantDepense'=>$montantDepense,'DemandeId'=>$DemandeId]);
            return true;
        }

         //Edition proprement dite de depense
         public function update_depense($idDepense,$destineDepense,$motifDepense,$montantDepense,$DemandeId){
            $sql="UPDATE `depense` SET `destineDepense`=:destineDepense,`motifDepense`=:motifDepense,`montantDepense`=:montantDepense,`dateDepense`=NOW(),`DemandeId`=:DemandeId WHERE idDepense=:idDepense";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['idDepense'=>$idDepense,'destineDepense'=>$destineDepense,'motifDepense'=>$motifDepense,'montantDepense'=>$montantDepense,'DemandeId'=>$DemandeId]);
            return true;
        }

         //Enregistrer edition demande
         public function update_rapport($idRapport,$montantDepense){
            $sql="UPDATE `rapport` SET Sortie=(Sortie+(:sortie)) WHERE idRapport=:id"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$idRapport,'sortie'=>$montantDepense]);
            return true;
        }

        //Enregistrer une demande depense 
        public function add_demande($Description,$motifDemande,$ServiceId){
            $sql="INSERT INTO `demande`(Description,motifDemande,dateDemande,ServiceId) VALUES (:Description,:motifDemande,NOW(),:ServiceId)"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['Description'=>$Description,'motifDemande'=>$motifDemande,'ServiceId'=>$ServiceId]);
            return true;
        }

         //Edition proprement dite de demande depense
         public function update_demande($idDemande,$Description,$motifDemande,$ServiceId){
            $sql="UPDATE `demande` SET `Description`=:Description,`motifDemande`=:motifDemande,`dateDemande`=NOW(),`ServiceId`=:ServiceId WHERE idDemande=:idDemande";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['idDemande'=>$idDemande,'Description'=>$Description,'motifDemande'=>$motifDemande,'ServiceId'=>$ServiceId]);
            return true;
        }

         //Edition proprement dite d'offrande
         public function update_offrande($idOffrande,$typeOffrande,$montantOffrande,$CulteId){
            $sql="UPDATE offrande SET typeOffrande=:typeOffrande,montantOffrande=:montantOffrande,dateOffrande=NOW(),CulteId=:CulteId WHERE idOffrande=:idOffrande";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['typeOffrande'=>$typeOffrande,'montantOffrande'=>$montantOffrande,'CulteId'=>$CulteId,'idOffrande'=>$idOffrande]);
            return true;
        }

         //Depot proprement dite d'offrande
         public function depot_offrande($idOffrande,$depot){
            $sql="UPDATE offrande SET depot=:depot WHERE idOffrande=:idOffrande";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['depot'=>$depot,'idOffrande'=>$idOffrande]);
            return true;
        }

         //Garder proprement dite d'offrande
         public function garder_offrande($idOffrande,$garder){
            $sql="UPDATE offrande SET garder=:garder WHERE idOffrande=:idOffrande";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['garder'=>$garder,'idOffrande'=>$idOffrande]);
            return true;
        }

        //Afficher toutes les Offrandes
        public function afficherOffrandes(){
            $sql="SELECT `idOffrande`, `typeOffrande`, `montantOffrande`, `dateOffrande`, `CulteId`,depot,culte.Culte as Culte, culte.dateCulte as Datee FROM `offrande` INNER JOIN culte ON culte.idCulte=offrande.CulteId WHERE depot=0";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }

         //Afficher toutes les demandes
         public function afficherDemandes(){
            $sql="SELECT `idDemande`, `Description`, `motifDemande`, `dateDemande`, `ServiceId`, service.Service as Service, eglise.Eglise as Eglise,`demandeExec` FROM `demande` INNER JOIN service ON service.idService=demande.ServiceId INNER JOIN eglise ON eglise.idEglise=service.EgliseId";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }

        //Afficher toutes les demandes executee
        public function afficherDemandesExec(){
            $sql="SELECT `idDemande`, `Description`, `motifDemande`, `dateDemande`, `ServiceId`, service.Service as Service, eglise.Eglise as Eglise,`demandeExec` FROM `demande` INNER JOIN service ON service.idService=demande.ServiceId INNER JOIN eglise ON eglise.idEglise=service.EgliseId WHERE demandeExec=0";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }

         //Enregistrer edition culte
         public function update_culte($CulteId){
            $sql="UPDATE `culte` SET `dateCulte`=NOW(),`etat`=1 WHERE idCulte=:id"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$CulteId]);
            return true;
        }

         //Enregistrer edition demande
         public function update_demandeExec($DemandeId){
            $sql="UPDATE `demande` SET `dateDemande`=NOW(),`demandeExec`=1 WHERE idDemande=:id"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$DemandeId]);
            return true;
        }

         //Enregistrer edition depense offrande
         public function update_SoustrationOffrande($id,$montant){
            $sql="UPDATE `offrande` SET `montantOffrande`=((montantOffrande)-(:Montant)),`dateOffrande`=NOW() WHERE depot=1 AND garder=1 AND idOffrande=:id"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id,'Montant'=>$montant]);
            return true;
        }

        //Afficher toutes les depenses
        public function afficherDepenses(){
            $sql="SELECT `idDepense`, `destineDepense`, `motifDepense`, `montantDepense`, `dateDepense`, `DemandeId`, demande.Description as Description, demande.motifDemande as MotifDepense, service.Service as Service, eglise.Eglise as Eglise FROM `depense` INNER JOIN demande ON demande.idDemande=depense.DemandeId INNER JOIN service ON service.idService=demande.ServiceId INNER JOIN eglise ON eglise.idEglise=service.EgliseId";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }

        //Afficher toutes  les Offrandes deposees
        public function afficherdepotOffrandes(){
            $sql="SELECT `idOffrande`, `typeOffrande`, `montantOffrande`, `dateOffrande`, `CulteId`, depot, culte.Culte as Culte, culte.dateCulte as Datee FROM `offrande` INNER JOIN culte ON culte.idCulte=offrande.CulteId WHERE depot=1";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }

         //Afficher tous  les rapports d'Offrandes deposes
         public function afficherRapportOffrandes(){
            $sql="SELECT `idRapport`, SUM(`Entree`) as MontantEntre,SUM(`Sortie`) as MontantSortie, `Offrande_type`,SUM((Entree-Sortie)) as Reste, `dateRapport` FROM `rapport` GROUP BY Offrande_type,dateRapport";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }

         //Afficher toutes  les Offrandes gardees
         public function affichergarderOffrandes(){
            $sql="SELECT `idOffrande`, `typeOffrande`, `montantOffrande`, `dateOffrande`, `CulteId`, garder, culte.Culte as Culte, culte.dateCulte as Datee FROM `offrande` INNER JOIN culte ON culte.idCulte=offrande.CulteId WHERE garder=1";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }

        //Afficher toutes  les depenses Offrandes
        public function afficherdepenseOffrandes(){
            $sql="SELECT `idDepense`, `destineDepense`, `motifDepense`, `montantDepense`, `dateDepense`, `DemandeId`, demande.Description, service.Service as Services FROM `depense` INNER JOIN demande ON demande.idDemande=depense.DemandeId INNER JOIN service ON service.idService=demande.ServiceId";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }


        //Affichage avant l'édition des offrandes existante dans la base de données
        public function editeroffrande($id){
            $sql="SELECT * FROM `offrande` WHERE `idOffrande`=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            $result=$stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        //Affichage avant l'édition des demandes existante dans la base de données
        public function editerdemande($id){
            $sql="SELECT * FROM `demande` WHERE `idDemande`=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            $result=$stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        //Affichage avant l'édition des demandes detaille existante dans la base de données
        public function editerdemandes($id){
            $sql="SELECT `idDemande`, `Description`, `motifDemande`, `dateDemande`, `ServiceId`, service.Service as Service, eglise.Eglise as Eglise,`demandeExec` FROM `demande` INNER JOIN service ON service.idService=demande.ServiceId INNER JOIN eglise ON eglise.idEglise=service.EgliseId WHERE `idDemande`=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            $result=$stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        //Affichage avant l'édition des depenses existante dans la base de données
        public function editerdepense($id){
            $sql="SELECT * FROM `depense` WHERE `idDepense`=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            $result=$stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        //Affichage avant l'édition des offrandes existante dans la base de données
        public function editeroffrandes($id){
            $sql="SELECT `idOffrande`, `typeOffrande`, `montantOffrande`, `dateOffrande`, `CulteId`, depot,culte.Culte as Culte, culte.dateCulte as Datee FROM `offrande` INNER JOIN culte ON culte.idCulte=offrande.CulteId WHERE `idOffrande`=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            $result=$stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

         //Delete A Offrande  by User
         public function deleteOffrande($id){
            $sql="DELETE FROM `offrande` WHERE idOffrande=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            return true;
        }

         //Delete A Demande  by User
         public function deleteDemande($id){
            $sql="DELETE FROM `demande` WHERE idDemande=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            return true;
        }

        //Delete A Depense  by User
        public function deleteDepense($id){
            $sql="DELETE FROM `depense` WHERE idDepense=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            return true;
        }

         //Compteur de nombres des lignes dans chaque tables
         public function totalCount($tablename){
            $sql="SELECT * FROM $tablename";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $count=$stmt->rowCount();
            return $count;
        }

         //Compteur de nombre 
         public function totalOffrandeDeposee(){
            $sql="SELECT `idOffrande`, `typeOffrande`, `montantOffrande`, `dateOffrande`, `CulteId`, `depot`, `garder` FROM `offrande` WHERE depot=1";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $count=$stmt->rowCount();
            return $count;
        }

        //Compteur de nombre 
        public function totalOffrandeNonDeposee(){
            $sql="SELECT `idOffrande`, `typeOffrande`, `montantOffrande`, `dateOffrande`, `CulteId`, `depot`, `garder` FROM `offrande` WHERE depot=0";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $count=$stmt->rowCount();
            return $count;
        }

         //Compteur de nombre 
         public function totalrapportOffrande(){
            $sql="SELECT `idRapport`, `Entree`, `Sortie`, `Offrande_type`, `dateRapport` FROM `rapport`";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $count=$stmt->rowCount();
            return $count;
        }

         
        //Compteur de nombre 
        public function totalDemandeNonExec(){
            $sql="SELECT `idDemande`, `Description`, `motifDemande`, `dateDemande`, `ServiceId`, `demandeExec` FROM `demande` WHERE `demandeExec`=0";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $count=$stmt->rowCount();
            return $count;
        } 
        
        //Compteur de nombre 
        public function totalDemandeExec(){
            $sql="SELECT `idDemande`, `Description`, `motifDemande`, `dateDemande`, `ServiceId`, `demandeExec` FROM `demande` WHERE `demandeExec`=1";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $count=$stmt->rowCount();
            return $count;
        }

         //Montant Général depense Générée  
         public function depenseTotalGenerals(){
            $sql="SELECT `idDepense`, `destineDepense`, `motifDepense`, SUM(montantDepense) as Montant, `dateDepense`, `DemandeId` FROM depense";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $count=$stmt->fetch(PDO::FETCH_ASSOC);
            return $count;
        }

        //Compteur de nombre 
        public function totalOffrandeGardee(){
            $sql="SELECT `idOffrande`, `typeOffrande`, `montantOffrande`, `dateOffrande`, `CulteId`, `depot`, `garder` FROM `offrande` WHERE garder=1";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $count=$stmt->rowCount();
            return $count;
        }

    }
?>