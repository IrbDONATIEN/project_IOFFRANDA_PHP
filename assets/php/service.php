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
            <span class="text-light lead align-self-center"><i class="fas fa-business-time"></i>&nbsp;Tous les services</span>
              <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addServicesModal"><i class="fas fa-business-time"></i>&nbsp;Ajouter Service</a>
            </h5>
        <div class="card-body">
        <div class="table-responsive" id="afficherServices">
            <p class="text-center lead mt-5">Veuillez patienter...</p>
        </div>
    </div>
</div>
<!--Début d'Ajout Service-->
<div class="modal fade" id="addServicesModal">
    <div class="modal-dialog modal-dialog-justify col-lg-16">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light"><i class="fa fa-university" aria-hidden="true"></i>&nbsp;Ajouter Eglise</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="add-service-form" class="px-3">
                    <div id="serviceAlert" class="text-danger text-center mt-2 font-weight-bold"></div>
                    <div class="form-group">
                        <input type="text" name="Service" id="Service" class="form-control form-control-lg" placeholder="Entrer Nom Service" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="EgliseId">Sélectionner Eglise:</label>
                        <select name="EgliseId" id="EgliseId" class="form-control form-control-lg" required>
                            <?php $req=$db->query("SELECT `idEglise`, `Eglise` FROM `eglise`");
                                while ($tab=$req->fetch()){?>
                                    <option value="<?php echo $tab['idEglise'];?>"><?php echo $tab['Eglise'];?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addService" class="btn btn-info btn-block btn-lg" id="addServiceBtn" value="Ajouter Service" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin d'Ajout Service-->
<!--Début Edition Service-->
<div class="modal fade" id="EditServiceModal">
    <div class="modal-dialog modal-dialog-justify col-lg-16">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h4 class="modal-title text-light"><i class="fa fa-university" aria-hidden="true"></i>&nbsp;Modifier Eglise</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="edit-service-form" class="px-3">
                    <div id="serviceAlert" class="text-danger text-center mt-2 font-weight-bold"></div>
                    <input type="hidden" name="idService" id="idService">
                    <div class="form-group">
                        <input type="text" name="Service" id="eService" class="form-control form-control-lg" placeholder="Modifier Service" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="EgliseId">Sélectionner Eglise:</label>
                        <select name="EgliseId" id="eEgliseId" class="form-control form-control-lg" required>
                            <?php $req=$db->query("SELECT `idEglise`, `Eglise` FROM `eglise`");
                                while ($tab=$req->fetch()){?>
                                    <option value="<?php echo $tab['idEglise'];?>"><?php echo $tab['Eglise'];?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="editService" class="btn btn-secondary btn-block btn-lg" id="editServiceBtn" value="Modifier Service" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin d'edition Service-->
<?php
    require_once 'footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){

        //Ajouter Service en Ajax Request
        $("#addServiceBtn").click(function(e){
            if($("#add-service-form")[0].checkValidity()){
                e.preventDefault();
                $("#addServiceBtn").val('Veuillez patienter...');
                $.ajax({
                    url:'processAdmin.php',
                    method:'post',
                    data:$("#add-service-form").serialize()+'&action=createService',
                    success:function(response){
                        $("#addServiceBtn").val('Ajouter Service');
                        $("#add-service-form")[0].reset();
                        $("#addServicesModal").modal('hide');
                        Swal.fire({
                            title:'Service ajouté avec succès !',
                            type:'success'
                        });
                        //Fetch All Services Ajax Request
                        afficherServices();
                        $("#serviceAlert").html(response);
                    }
                });
            }
        });

        //Fetch All Services Ajax Request
        afficherServices();

        function afficherServices(){
            $.ajax({
                url:'processAdmin.php',
                method: 'post',
                data:{action: 'afficherServices'},
                success:function(response){
                    $("#afficherServices").html(response);
                    $("table").DataTable({
                        order:[0, 'desc']
                    });
                }
            });
        }

         //Supprimer service
         $("body").on("click", ".deleteServiceIcon", function(e){
                e.preventDefault();

                supprimer_service=$(this).attr('id');

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
                            data:{supprimer_service:supprimer_service},
                            success:function(response){
                                Swal.fire(
                                    'Supprimer Service !',
                                    'Service supprimé avec succès.',
                                    'success'
                                )
                                afficherServices();
                            } 
                        });
                        
                    }
                })

        });

        //Editer Service en Ajax request
        $("body").on("click",".editServiceBtn", function(e){
            e.preventDefault();

            editservice_id=$(this).attr('id');
            $.ajax({
                    url:'processAdmin.php',
                    method:'post',
                    data:{editservice_id:editservice_id},
                    success:function(response){
                        data=JSON.parse(response);
                        $("#idService").val(data.idService);
                        $("#eService").val(data.Service);
                        $("#eEgliseId").val(data.EgliseId);
                    }
                });
                
        });

         //Modifier Service en Ajax Request
         $("#editServiceBtn").click(function(e){
                if($("#edit-service-form")[0].checkValidity()){
                    e.preventDefault();

                    $.ajax({
                        url:'processAdmin.php',
                        method:'post',
                        data:$("#edit-service-form").serialize()+"&action=update_service",
                        success:function(response){
                            Swal.fire({
                                title:'Service mise à jour avec succès !',
                                type:'success'
                            });
                            $("#edit-service-form")[0].reset();
                            $("#EditServiceModal").modal('hide');
                            afficherServices();
                        }
                    });
                }
            });
            //Voir les details de service avec ajax
            $("body").on("click",".infoServiceBtn", function(e){
                e.preventDefault();

                infoservice_id=$(this).attr('id');
                $.ajax({
                    url:'processAdmin.php',
                    method:'post',
                    data:{infoservice_id:infoservice_id},
                    success:function(response){
                        data=JSON.parse(response);
                        Swal.fire({
                            title:'<strong>Service :ID('+data.idService+')</strong>',
                            type:'info',
                            html:'<b>Service :</b>'+data.Service+'</br></br><b>Eglise:</b>'+data.Eglise,
                        });
                    }
                });
            });

    });
</script>
</body>
</html>