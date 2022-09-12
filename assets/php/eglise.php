<?php
    require_once 'header.php';
?>
<div class="container mt-2">
    <div class="mt-2">
            <img src="../images/logo.png">
    </div>
    <hr class=" bg-primary">
    <div class="card border-info mt-2">
            <h5 class="card-header bg-info d-flex justify-content-between">
            <span class="text-light lead align-self-center"><i class="fa fa-university" aria-hidden="true"></i>&nbsp;Toutes les Eglises</span>
              <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addEglisesModal"><i class="fa fa-university" aria-hidden="true"></i>&nbsp;Ajouter Eglise</a>
            </h5>
        <div class="card-body">
        <div class="table-responsive" id="afficherEglises">
            <p class="text-center lead mt-5">Veuillez patienter...</p>
        </div>
    </div>
</div>
<!--Début d'Ajout Eglise-->
<div class="modal fade" id="addEglisesModal">
    <div class="modal-dialog modal-dialog-justify col-lg-16">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light"><i class="fa fa-university" aria-hidden="true"></i>&nbsp;Ajouter Eglise</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="add-eglise-form" class="px-3">
                    <div id="egliseAlert" class="text-danger text-center mt-2 font-weight-bold"></div>
                    <div class="form-group">
                        <input type="text" name="eglise" id="eglise" class="form-control form-control-lg" placeholder="Entrer Nom Eglise" required autofocus>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addEglise" class="btn btn-info btn-block btn-lg" id="addEgliseBtn" value="Ajouter Eglise" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin d'Ajout Eglise-->
<!--Début Edition Eglise-->
<div class="modal fade" id="EditEgliseModal">
    <div class="modal-dialog modal-dialog-justify col-lg-16">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h4 class="modal-title text-light"><i class="fa fa-university" aria-hidden="true"></i>&nbsp;Modifier Eglise</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="edit-eglise-form" class="px-3">
                    <div id="eglisesAlert" class="text-danger text-center mt-2 font-weight-bold"></div>
                    <input type="hidden" name="idEglise" id="idEglise">
                    <div class="form-group">
                        <input type="text" name="Eglise" id="Eglise" class="form-control form-control-lg" placeholder="Modifier Nom Eglise" required autofocus>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="editEglise" class="btn btn-secondary btn-block btn-lg" id="editEglisesBtn" value="Modifier Eglise" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin d'Ajout Eglise-->
<?php
    require_once 'footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){

        //Ajouter Eglise en Ajax Request
        $("#addEgliseBtn").click(function(e){
            if($("#add-eglise-form")[0].checkValidity()){
                e.preventDefault();
                $("#addEgliseBtn").val('Veuillez patienter...');
                $.ajax({
                    url:'processAdmin.php',
                    method:'post',
                    data:$("#add-eglise-form").serialize()+'&action=createChurch',
                    success:function(response){
                        $("#addEgliseBtn").val('Ajouter Eglise');
                        $("#add-eglise-form")[0].reset();
                        $("#addEglisesModal").modal('hide');
                        Swal.fire({
                            title:'Eglise ajoutée avec succès !',
                            type:'success'
                        });
                        //Fetch All Eglises Ajax Request
                        afficherEglises();
                        $("#egliseAlert").html(response);
                    }
                });
            }
        });

        //Fetch All Eglises Ajax Request
        afficherEglises();

        function afficherEglises(){
            $.ajax({
                url:'processAdmin.php',
                method: 'post',
                data:{action: 'afficherEglises'},
                success:function(response){
                    $("#afficherEglises").html(response);
                    $("table").DataTable({
                        order:[0, 'desc']
                    });
                }
            });
        }

         //Supprimer eglise
         $("body").on("click", ".deleteEgliseIcon", function(e){
                e.preventDefault();

                supprimer_eglise=$(this).attr('id');

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
                            url:'processAdmin.php',
                            method:'post',
                            data:{supprimer_eglise:supprimer_eglise},
                            success:function(response){
                                Swal.fire(
                                    'Supprimer Eglise !',
                                    'Eglise supprimée avec succès.',
                                    'success'
                                )
                                afficherEglises();
                            } 
                        });
                        
                    }
                })

        });

        //Editer Eglise en Ajax request
        $("body").on("click",".editEgliseBtn", function(e){
            e.preventDefault();

            editeglise_id=$(this).attr('id');
            $.ajax({
                    url:'processAdmin.php',
                    method:'post',
                    data:{editeglise_id:editeglise_id},
                    success:function(response){
                        data=JSON.parse(response);
                        $("#idEglise").val(data.idEglise);
                        $("#Eglise").val(data.Eglise);
                    }
                });
                
        });

         //Modifier Eglise en Ajax Request
         $("#editEglisesBtn").click(function(e){
                if($("#edit-eglise-form")[0].checkValidity()){
                    e.preventDefault();

                    $.ajax({
                        url:'processAdmin.php',
                        method:'post',
                        data:$("#edit-eglise-form").serialize()+"&action=update_eglise",
                        success:function(response){
                            Swal.fire({
                                title:'Eglise mise à jour avec succès !',
                                type:'success'
                            });
                            $("#edit-eglise-form")[0].reset();
                            $("#EditEgliseModal").modal('hide');
                            afficherEglises();
                        }
                    });
                }
            });

            //Voir les details de l'Eglise avec ajax
            $("body").on("click",".infoEgliseBtn", function(e){
                e.preventDefault();

                infoeglise_id=$(this).attr('id');
                $.ajax({
                    url:'processAdmin.php',
                    method:'post',
                    data:{infoeglise_id:infoeglise_id},
                    success:function(response){
                        data=JSON.parse(response);
                        Swal.fire({
                            title:'<strong>Eglise :ID('+data.idEglise+')</strong>',
                            type:'info',
                            html:'<b>Eglise :</b>'+data.Eglise,
                        });
                    }
                });
            });

    });
</script>
</body>
</html>