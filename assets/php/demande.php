<?php
    require_once 'headerUs.php';
    require_once 'connexion.php';
?>
<div class="container mt-1">
    <div class="mt-1">
            <img src="../images/logo.png">
    </div>
    <hr class="bg-primary">
    <div class="alert alert-info bg-success alert-dismissible text-center text-white mt-2 m-0">
        <div class="col-lg-16">
            <strong>Bienvenu(e) dans le système d'Utilisateur de gestion d'offrande iOffranda | Service:<?= $cservice ;?> | Nom:<?= $cnom ;?></strong>
        </div>
    </div>
    <div class="card border-info mt-1">
          <h5 class="card-header bg-info d-flex justify-content-between">
            <span class="text-light lead align-self-center"><i class="fa fa-pen"></i>&nbsp;Toutes les Demandes Depenses</span>
            <a href="#" class="btn btn-light" data-toggle="modal" data-target="#demandeOffrandesModal"><i class="fa fa-pen"></i>&nbsp;Ecrire Demande Depense</a>
          </h5>
    <div class="card-body">
        <div class="table-responsive" id="afficherDemandes">
            <p class="text-center lead mt-5">Veuillez patienter...</p>
        </div>
    </div>
    </div>
<!--Début d'Ajout Demande-->
<div class="modal fade" id="demandeOffrandesModal">
    <div class="modal-dialog modal-dialog-justify col-lg-16">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light"><i class="fa fa-pen"></i>&nbsp;Ecrire Demande Depense</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="demande-offrande-form" class="px-3">
                    <div class="form-group">
                        <label for="motifDemande">Entrer Motif Demande:</label>
                        <input type="text" name="motifDemande" id="motifDemande" class="form-control form-control-lg" placeholder="Entrer Motif Demande" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="Description">Entrer Description Demande:</label>
                        <textarea name="Description" id="Description" cols="10" rows="5" class="form-control form-control-lg" placeholder="Entrer Description Demande" required></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="demandeOffrandes" class="btn btn-info btn-block btn-lg" id="demandeOffrandesBtn" value="Ecrire Demande Depense" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin d'Ajout Demandes-->
<!--Début d'Edition Demande-->
<div class="modal fade" id="EditDemandesModal">
    <div class="modal-dialog modal-dialog-justify col-lg-16">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-light"><i class="fa fa-pen"></i>&nbsp;Modifier Demande Depense</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="demande-edit-form" class="px-3">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id">
                        <label for="motifDemande">Modifier Motif Demande:</label>
                        <input type="text" name="motifDemande" id="emotifDemande" class="form-control form-control-lg" placeholder="Modifier Motif Demande" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="Description">Modifier Description Demande:</label>
                        <textarea name="Description" id="eDescription" cols="10" rows="5" class="form-control form-control-lg" placeholder="Modifier Description Demande" required></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="editdemandeOffrandes" class="btn btn-success btn-block btn-lg" id="editdemandeOffrandesBtn" value="Modifier Demande Depense" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin d'edition Demandes-->
<?php
    require_once 'footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){

         //Ecrire demande depense en Ajax Request
         $("#demandeOffrandesBtn").click(function(e){
            if($("#demande-offrande-form")[0].checkValidity()){
                e.preventDefault();
                $("#demandeOffrandesBtn").val('Veuillez patienter...');
                $.ajax({
                    url:'processUser.php',
                    method:'post',
                    data:$("#demande-offrande-form").serialize()+'&action=demandeOffrande',
                    success:function(response){ 
                        $("#demandeOffrandesBtn").val('Ecrire Demande Depense');
                        $("#demande-offrande-form")[0].reset();
                        $("#demandeOffrandesModal").modal('hide');
                        Swal.fire({
                            title:'Demande Depense écrite avec succès !',
                            type:'success'
                        });
                         //Fetch All Demandes Ajax Request
                         afficherDemandes();
                    }
                });
            }
        });

         //Fetch All Demandes Ajax Request
         afficherDemandes();

        function afficherDemandes(){
            $.ajax({
                url:'processUser.php',
                method: 'post',
                data:{action: 'afficherDemandes'},
                success:function(response){
                    $("#afficherDemandes").html(response);
                    $("table").DataTable({
                        order:[0, 'desc']
                    });
                }
            });
        }

        //Voir les details des demandes de depenses avec ajax
        $("body").on("click",".infodemandeBtn", function(e){
                e.preventDefault();

                infodemande_id=$(this).attr('id');
                $.ajax({
                    url:'processUser.php',
                    method:'post',
                    data:{infodemande_id:infodemande_id},
                    success:function(response){
                        data=JSON.parse(response);
                        Swal.fire({
                            title:'<strong>Demande :ID('+data.idDemande+')</strong>',
                            type:'info',
                            html:'<div class="col-lg-10 text-justify"><b>Motif demande: </b>'+data.motifDemande+'</br></br><b>Description: </b>'+data.Description+'</br></br><b>Date Enreg. Demande: </b>'+data.dateDemande+'</br></br><b>Service: </b>'+data.Service+'</br></br><b>Eglise: </b>'+data.Eglise+'</br></br><b>Demande Executee: </b>'+data.demandeExec,
                        });
                    }
                });
        });

                //Supprimer demande depense
                $("body").on("click", ".deleteDemandeIcon", function(e){
                e.preventDefault();

                supprimer_demande=$(this).attr('id');

                Swal.fire({
                    title: 'Etes-vous sûr de Supprimer ?',
                    text: "Vous ne pourrez pas revenir en arrière !",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, supprimez-la!'
                    }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url:'processUser.php',
                            method:'post',
                            data:{supprimer_demande:supprimer_demande},
                            success:function(response){
                                Swal.fire(
                                    'Supprimer Demande depense !',
                                    'Demande depense supprimée avec succès.',
                                    'success'
                                )
                                afficherDemandes();
                            } 
                        });
                        
                    }
                })

        });

        //Editer Demande de depense en Ajax request
        $("body").on("click",".editDemandeBtn", function(e){
            e.preventDefault();

            editdemande_id=$(this).attr('id');
            $.ajax({
                    url:'processUser.php',
                    method:'post',
                    data:{editdemande_id:editdemande_id},
                    success:function(response){
                        data=JSON.parse(response);
                        $("#id").val(data.idDemande);
                        $("#emotifDemande").val(data.motifDemande);
                        $("#eDescription").val(data.Description);
                    }
                });
                
        });

                 //Modifier demande de depense en Ajax Request
                 $("#editdemandeOffrandesBtn").click(function(e){
                if($("#demande-edit-form")[0].checkValidity()){
                    e.preventDefault();

                    $.ajax({
                        url:'processUser.php',
                        method:'post',
                        data:$("#demande-edit-form").serialize()+"&action=update_demande",
                        success:function(response){
                            Swal.fire({
                                title:'Demande depense mise à jour avec succès !',
                                type:'success'
                            });
                            $("#demande-edit-form")[0].reset();
                            $("#EditDemandesModal").modal('hide');
                            afficherDemandes();
                        }
                    });
                }
        });

        
    });
</script>
</body>
</html>