<?php
     require_once 'config.php';
     class Auth extends Database{

        //Login Utilisateur
        public function loginUser($login,$motdepasse,$typeService){
            $sql="SELECT login,motdepasse,typeService FROM utilisateur WHERE login=:login AND motdepasse=:motdepasse AND typeService=:typeService";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['login'=>$login,'motdepasse'=>$motdepasse,'typeService'=>$typeService]);
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            return $row;
        }

         //Afficher les détails de l'utilisateur  connecté
         public function currentUser($login){
            $sql="SELECT utilisateur.id,nom,postnom,prenom,sexe,telephone,login,motdepasse,type_utilisateur,service.Service FROM utilisateur INNER JOIN service ON utilisateur.typeService=service.idService WHERE login=:login";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['login'=>$login]);
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            return $row;
        }

     }
?>