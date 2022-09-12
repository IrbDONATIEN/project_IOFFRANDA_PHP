<?php
    require_once 'config.php';

    class Admin extends Database{

        //Admin Login
        public function admin_login($username, $password){
            $sql="SELECT username, password FROM administrateur WHERE username=:username AND password =:password";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['username'=>$username, 'password'=>$password]);
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            return $row;
        }

        //Login User
        public function user_login($login_user,$motdepasse,$typeService){
            $sql="SELECT loginUser,motdepasse,typeService FROM utilisateurs WHERE loginUser=:loginUser AND motdepasse=:motdepasse AND typeService=:typeService";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['loginUser'=>$login_user,'motdepasse'=>$motdepasse,'typeService'=>$typeService]);
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            return $row;
        }

        //Afficher les détails de l'utilisateur Admin  connecté
        public function currentAdmin($username){
            $sql="SELECT administrateur.id,username FROM administrateur WHERE username=:username";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['username'=>$username]);
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            return $row;
        }

        //Afficher les détails de l'utilisateur User  connecté
        public function currentUser($login_user){
            $sql="SELECT `id`, `nom`, `postnom`, `prenom`, `sexe`, `telephone`, `loginUser`, `motdepasse`, `typeService`, service.Service as Service FROM `utilisateurs` INNER JOIN service ON service.idService=utilisateurs.typeService WHERE `loginUser`=:loginUser";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['loginUser'=>$login_user]);
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            return $row;
        }

        //Compteur de nombres des lignes dans chaque tables
        public function totalCount($tablename){
            $sql="SELECT * FROM $tablename";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $count=$stmt->rowCount();
            return $count;
        }

        //Enregistrer une nouvelle eglise
        public function eglise($eglise){
            $sql="INSERT INTO eglise (eglise) VALUES (:eglise)"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['eglise'=>$eglise]);
            return true;
        }

        //Vérifier si l'Eglise existe déjà dans la base de données
        public function eglise_existe($eglise){
            $sql="SELECT eglise FROM eglise WHERE eglise=:eglise";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['eglise'=>$eglise]);
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        //Affichage avant l'édition de l'Eglise existante dans la base de données
        public function editereglise($id){
            $sql="SELECT * FROM eglise WHERE idEglise=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            $result=$stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        //Edition proprement dite de l'Eglise
        public function update_eglise($id, $eglise){
            $sql="UPDATE eglise SET eglise=:eglise WHERE idEglise=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['eglise'=>$eglise, 'id'=>$id]);
            return true;
        }

        //Delete A Church by Admin
        public function deleteEglise($id){
            $sql="DELETE FROM eglise WHERE idEglise=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            return true;
        }

        //Afficher toutes les eglises
        public function afficherEglises(){
            $sql="SELECT idEglise,eglise FROM eglise";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }

         //Enregistrer une nouvelle eglise
         public function culte($culte){
            $sql="INSERT INTO `culte`(`Culte`, `dateCulte`) VALUES (:Culte,NOW())"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['Culte'=>$culte]);
            return true;
        }

        //Afficher tous les cultes
        public function afficherCultes(){
            $sql="SELECT `idCulte`, `Culte`, `dateCulte`,etat FROM `culte`";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }


        //Enregistrer un nouveau service
        public function service($service,$EgliseId){
            $sql="INSERT INTO service (Service,EgliseId) VALUES (:Service,:EgliseId)"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['Service'=>$service,'EgliseId'=>$EgliseId]);
            return true;
        }

        //Vérifier si le service existe déjà dans la base de données
        public function service_exist($service){
            $sql="SELECT Service FROM service WHERE Service=:Service";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['Service'=>$service]);
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        //Affichage avant l'édition de service existant dans la base de données
        public function editerservice($id){
            $sql="SELECT * FROM service WHERE idService=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            $result=$stmt->fetch(PDO::FETCH_ASSOC);

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

        //Affichage avant l'édition de service existant dans la base de données
        public function editerservices($id){
            $sql="SELECT `idService`, `Service`, eglise.Eglise as Eglise FROM `service` INNER JOIN eglise ON eglise.idEglise=service.EgliseId WHERE idService=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            $result=$stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        //Edition proprement dite de service
        public function update_service($id,$service,$EgliseId){
            $sql="UPDATE service SET Service=:Service, EgliseId=:EgliseId WHERE idService=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['Service'=>$service,'EgliseId'=>$EgliseId,'id'=>$id]);
            return true;
        }

        //Delete A Service  by Admin
        public function deleteService($id){
            $sql="DELETE FROM service WHERE idService=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            return true;
        }

        //Afficher tous les services
        public function afficherServices(){
            $sql="SELECT idService,Service,eglise.Eglise as Eglise FROM service INNER JOIN eglise ON eglise.idEglise=service.EgliseId";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }

         //Montant Général offrande Générée  
         public function offrandeTotalGenerals(){
            $sql="SELECT `idOffrande`, `typeOffrande`, SUM(montantOffrande) as Montants, `dateOffrande`, `CulteId` FROM offrande";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $count=$stmt->fetch(PDO::FETCH_ASSOC);
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
        public function totalDemandeExec(){
            $sql="SELECT `idDemande`, `Description`, `motifDemande`, `dateDemande`, `ServiceId`, `demandeExec` FROM `demande` WHERE `demandeExec`=1";
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
        
    }
?>