<?php
    require_once 'header.php';
    require_once 'connexion.php';
?>
<div class="container mt-2">
    <div class="mt-2">
            <img src="../images/logo.png">
    </div>
    <hr>
    <div class="card border-info mt-2">
            <h5 class="card-header bg-info d-flex justify-content-between">
            <span class="text-light lead align-self-center"><i class="fa fa-user"></i>&nbsp;Tous les utilisateurs</span>
              <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addUtilisateursModal"><i class="fa fa-user"></i>&nbsp;Ajouter Utilisateur</a>
            </h5>
        <div class="card-body">
        <div class="table-responsive" id="afficherUtilisateurs">
            <p class="text-center lead mt-5">Veuillez patienter...</p>
        </div>
    </div>
</div>
<!--Début d'Ajout Utilisateur-->
<div class="modal fade" id="addUtilisateursModal">
    <div class="modal-dialog modal-dialog-justify col-lg-16">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light"><i class="fa fa-user" ></i>&nbsp;Ajouter Utilisateur</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="add-utilisateur-form" class="px-3">
                    <div id="utilisateurAlert" class="text-danger text-center mt-2 font-weight-bold"></div>
                    <div class="form-group">
                        <input type="text" name="nom" id="nom" class="form-control form-control-lg" placeholder="Entrer Nom Utilisateur" required autofocus>
                    </div>
                    <div class="form-group">
                        <input type="text" name="postnom" id="postnom" class="form-control form-control-lg" placeholder="Entrer Postnom Utilisateur" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="prenom" id="prenom" class="form-control form-control-lg" placeholder="Entrer Prenom Utilisateur" required>
                    </div>
                    <div class="form-group">
                        <label for="sexe">Séléctionner Sexe :</label>
                        <select name="sexe" id="sexe" class="form-control form-control-lg">
                            <option value="" disabled>Séléctionner Sexe</option>
                            <option value="Masculin" required>Masculin</option>
                            <option value="Feminin" required>Feminin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="telephone" id="telephone" class="form-control form-control-lg" placeholder="Entrer mot telephone utilisateur" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="loginUser" id="loginUser" class="form-control form-control-lg" placeholder="Entrer Login Utilisateur" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="motdepasse" id="motdepasse" class="form-control form-control-lg" placeholder="Entrer mot de passe utilisateur" required>
                    </div>
                    <div class="form-group">
                        <label for="typeService">Sélectionner Service:</label>
                        <select name="typeService" id="typeService" class="form-control form-control-lg" required>
                            <?php $req=$db->query("SELECT `idService`, `Service` FROM `service`");
                                while ($tab=$req->fetch()){?>
                                    <option value="<?php echo $tab['idService'];?>"><?php echo $tab['Service'];?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addUtilisateur" class="btn btn-info btn-block btn-lg" id="addUtilisateurBtn" value="Ajouter Utilisateur" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin d'Ajout Utilisateur-->
<!--Début d'edit Utilisateur-->
<div class="modal fade" id="EditUtilisateurModal">
    <div class="modal-dialog modal-dialog-justify col-lg-16">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h4 class="modal-title text-light"><i class="fa fa-user" ></i>&nbsp;Modifier Utilisateur</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="edit-utilisateur-form" class="px-3">
                    <input type="hidden" name="id" id="id">
                    <div id="utilisateurAlert" class="text-danger text-center mt-2 font-weight-bold"></div>
                    <div class="form-group">
                        <input type="text" name="nom" id="enom" class="form-control form-control-lg" placeholder="Entrer Nom Utilisateur" required autofocus>
                    </div>
                    <div class="form-group">
                        <input type="text" name="postnom" id="epostnom" class="form-control form-control-lg" placeholder="Entrer Postnom Utilisateur" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="prenom" id="eprenom" class="form-control form-control-lg" placeholder="Entrer Prenom Utilisateur" required>
                    </div>
                    <div class="form-group">
                        <label for="sexe">Séléctionner Sexe :</label>
                        <select name="sexe" id="esexe" class="form-control form-control-lg">
                            <option value="" disabled>Séléctionner Sexe</option>
                            <option value="Masculin" required>Masculin</option>
                            <option value="Feminin" required>Feminin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="telephone" id="etelephone" class="form-control form-control-lg" placeholder="Entrer mot telephone utilisateur" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="login" id="elogin" class="form-control form-control-lg" placeholder="Entrer Login Utilisateur" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="motdepasse" id="emotdepasse" class="form-control form-control-lg" placeholder="Entrer mot de passe utilisateur" required>
                    </div>
                    <div class="form-group">
                        <label for="typeService">Sélectionner Service:</label>
                        <select name="typeService" id="etypeService" class="form-control form-control-lg" required>
                            <?php $req=$db->query("SELECT `idService`, `Service` FROM `service`");
                                while ($tab=$req->fetch()){?>
                                    <option value="<?php echo $tab['idService'];?>"><?php echo $tab['Service'];?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="editUtilisateur" class="btn btn-secondary btn-block btn-lg" id="editUtilisateurBtn" value="Modifier Utilisateur" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin d'edit Utilisateur-->
<?php
    require_once 'footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){

        //Ajouter Utilisateur en Ajax Request
        $("#addUtilisateurBtn").click(function(e){
            if($("#add-utilisateur-form")[0].checkValidity()){
                e.preventDefault();
                $("#addUtilisateurBtn").val('Veuillez patienter...');
                $.ajax({
                    url:'processAdmin.php',
                    method:'post',
                    data:$("#add-utilisateur-form").serialize()+'&action=createUtilisateur',
                    success:function(response){
                        $("#addUtilisateurBtn").val('Ajouter Utilisateur');
                        $("#add-utilisateur-form")[0].reset();
                        $("#addUtilisateursModal").modal('hide');
                        Swal.fire({
                            title:'Utilisateur ajouté avec succès !',
                            type:'success'
                         });
                        //Fetch All Utilisateurs Ajax Request
                        afficherUtilisateurs();
                        $("#utilisateurAlert").html(response);
                    }
                });
            }
        });

        //Fetch All Utilisateurs Ajax Request
        afficherUtilisateurs();

        function afficherUtilisateurs(){
            $.ajax({
                url:'processAdmin.php',
                method: 'post',
                data:{action: 'afficherUtilisateurs'},
                success:function(response){
                    $("#afficherUtilisateurs").html(response);
                    $("table").DataTable({
                        order:[0, 'desc']
                    });
                }
            });
        }

         //Supprimer utilisateur
         $("body").on("click", ".deleteUtilisateurIcon", function(e){
                e.preventDefault();

                supprimer_utilisateur=$(this).attr('id');

                Swal.fire({
                    title: 'Etes-vous sûr de Supprimer ?',
                    text: "Vous ne pourrez pas revenir en arrière !",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, supprimez-le!'
                    }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url:'processAdmin.php',
                            method:'post',
                            data:{supprimer_utilisateur:supprimer_utilisateur},
                            success:function(response){
                                Swal.fire(
                                    'Supprimer Utilisateur !',
                                    'Utilisateur supprimé avec succès.',
                                    'success'
                                )
                                afficherUtilisateurs();
                            } 
                        });
                        
                    }
                })

        });

        //Editer Utilisateur en Ajax request
        $("body").on("click",".editUtilisateurBtn", function(e){
            e.preventDefault();

            editutilisateur_id=$(this).attr('id');
            $.ajax({
                    url:'processAdmin.php',
                    method:'post',
                    data:{editutilisateur_id:editutilisateur_id},
                    success:function(response){
                        data=JSON.parse(response);
                        $("#id").val(data.id);
                        $("#enom").val(data.nom);
                        $("#epostnom").val(data.postnom);
                        $("#eprenom").val(data.prenom);
                        $("#esexe").val(data.sexe);
                        $("#etelephone").val(data.telephone);
                        $("#elogin").val(data.loginUser);
                        $("#emotdepasse").val(data.motdepasse);
                        $("#etypeService").val(data.typeService);
                    }
                });
                
        });

         //Modifier Utilisateur en Ajax Request
         $("#editUtilisateurBtn").click(function(e){
                if($("#edit-utilisateur-form")[0].checkValidity()){
                    e.preventDefault();

                    $.ajax({
                        url:'processAdmin.php',
                        method:'post',
                        data:$("#edit-utilisateur-form").serialize()+"&action=update_utilisateur",
                        success:function(response){
                            Swal.fire({
                                title:'Utilisateur mise à jour avec succès !',
                                type:'success'
                            });
                            $("#edit-utilisateur-form")[0].reset();
                            $("#EditUtilisateurModal").modal('hide');
                            afficherUtilisateurs();
                        }
                    });
                }
            });

            //Voir les details de l'Utilisateur avec ajax
            $("body").on("click",".infoUtilisateurBtn", function(e){
                e.preventDefault();

                infoutilisateur_id=$(this).attr('id');
                $.ajax({
                    url:'processAdmin.php',
                    method:'post',
                    data:{infoutilisateur_id:infoutilisateur_id},
                    success:function(response){
                        data=JSON.parse(response);
                        Swal.fire({
                            title:'<strong>Utilisateur :ID('+data.id+')</strong>',
                            type:'info',
                            html:'<b>Nom :</b>'+data.nom+'</br></br><b>Postnom :</b>'+data.postnom+'</br></br><b>Prenom :</b>'+data.prenom+'</br></br><b>Sexe :</b>'+data.sexe+'</br></br><b>Telephone :</b>'+data.telephone+'</br></br><b>Login :</b>'+data.loginUser+'</br></br><b>Mot de Passe :</b>'+data.motdepasse+'</br></br><b>Service :</b>'+data.Service+'</br></br><b>Eglise :</b>'+data.Eglise,
                        });
                    }
                });
            });

    });
</script>
</body>
</html>