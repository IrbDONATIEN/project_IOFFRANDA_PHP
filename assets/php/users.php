<?php
    require_once 'config.php';

    class Users extends Database{
        
        //UTILISATEURS
                //Enregistrer un nouvel utilisateur
                public function utilisateurs($nom,$postnom,$prenom,$sexe,$telephone,$loginUser,$motdepasse,$typeService){
                    $sql="INSERT INTO utilisateurs (nom,postnom,prenom,sexe,telephone,loginUser,motdepasse,typeService) VALUES (:nom,:postnom,:prenom,:sexe,:telephone,:loginUser,:motdepasse,:typeService)"; 
                    $stmt=$this->conn->prepare($sql);
                    $stmt->execute(['nom'=>$nom,'postnom'=>$postnom,'prenom'=>$prenom,'sexe'=>$sexe,'telephone'=>$telephone,'loginUser'=>$loginUser,'motdepasse'=>$motdepasse,'typeService'=>$typeService]);
                    return true;
                }
                //Vérifier si l'utilisateur existe déjà dans la base de données
                public function utilisateur_exist($loginUser){
                    $sql="SELECT loginUser FROM utilisateurs WHERE loginUser=:loginUser";
                    $stmt=$this->conn->prepare($sql);
                    $stmt->execute(['loginUser'=>$loginUser]);
                    $result=$stmt->fetch(PDO::FETCH_ASSOC);
                    return $result;
                }
        
                //Affichage avant l'édition de l'utilisateur existant dans la base de données
                public function editerutilisateur($id){
                    $sql="SELECT * FROM utilisateurs WHERE id=:id";
                    $stmt=$this->conn->prepare($sql);
                    $stmt->execute(['id'=>$id]);
        
                    $result=$stmt->fetch(PDO::FETCH_ASSOC);
        
                    return $result;
                }
        
                //Affichage avant l'édition de l'utilisateur existant dans la base de données
                public function editerutilisateurs($id){
                    $sql="SELECT `id`, `nom`, `postnom`, `prenom`, `sexe`, `telephone`, `loginUser`, `motdepasse`, service.Service as Service, Service.EgliseId, eglise.Eglise as Eglise FROM `utilisateurs` INNER JOIN service ON service.idService=utilisateurs.typeService INNER JOIN eglise ON eglise.idEglise=service.EgliseId WHERE id=:id";
                    $stmt=$this->conn->prepare($sql);
                    $stmt->execute(['id'=>$id]);
        
                    $result=$stmt->fetch(PDO::FETCH_ASSOC);
        
                    return $result;
                }
        
                //Edition proprement dite de l'utilisateur
                public function update_utilisateur($id,$nom,$postnom,$prenom,$sexe,$telephone,$loginUser,$motdepasse,$typeService){
                    $sql="UPDATE `utilisateurs` SET `nom`=:nom,`postnom`=:postnom,`prenom`=:prenom,`sexe`=:sexe,`telephone`=:telephone,`loginUser`=:loginUser,`motdepasse`=:motdepasse,`typeService`=:typeService WHERE id=:id";
                    $stmt=$this->conn->prepare($sql);
                    $stmt->execute(['nom'=>$nom,'postnom'=>$postnom,'prenom'=>$prenom,'sexe'=>$sexe,'telephone'=>$telephone,'loginUser'=>$loginUser,'motdepasse'=>$motdepasse,'typeService'=>$typeService,'id'=>$id]);
                    return true;
                }
        
                //Delete A Users  by Admin
                public function deleteUtilisateur($id){
                    $sql="DELETE FROM utilisateurs WHERE id=:id";
                    $stmt=$this->conn->prepare($sql);
                    $stmt->execute(['id'=>$id]);
        
                    return true;
                }
        
                //Afficher tous les utilisateurs
                public function afficherUtilisateurs(){
                    $sql="SELECT `id`, `nom`, `postnom`, `prenom`, `sexe`, `telephone`, `loginUser`, `motdepasse`, service.Service as Service, Service.EgliseId, eglise.Eglise as Eglise FROM `utilisateurs` INNER JOIN service ON service.idService=utilisateurs.typeService INNER JOIN eglise ON eglise.idEglise=service.EgliseId";
                    $stmt=$this->conn->prepare($sql);
                    $stmt->execute();
                    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    return $result;
                }
    }
?>