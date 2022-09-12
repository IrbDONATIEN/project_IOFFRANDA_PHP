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
            <span class="text-light lead align-self-center"><i class="fas fa-money-check-alt"></i>&nbsp;Toutes les Offrandes</span>
            <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#depotOffrandesModal"><i class="fas fa-money-check-alt"></i>&nbsp;Dépôt Offrande</a>
            <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addOffrandesModal"><i class="fas fa-money-check-alt"></i>&nbsp;Ajouter Offrande</a>
          </h5>
    <div class="card-body">
        <div class="table-responsive" id="afficherOffrandes">
            <p class="text-center lead mt-5">Veuillez patienter...</p>
        </div>
    </div>
    </div>
<!--Début d'Ajout Offrande-->
<div class="modal fade" id="addOffrandesModal">
    <div class="modal-dialog modal-dialog-justify col-lg-16">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light"><i class="fas fa-money-check-alt"></i>&nbsp;Ajouter Offrande</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="add-offrande-form" class="px-3">
                    <div class="form-group">
                        <label for="montantOffrande">Entrer Montant Offrande:</label>
                        <input type="number" name="montantOffrande" id="montantOffrande" class="form-control form-control-lg" placeholder="Entrer montant Offrande" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="typeOffrande">Séléctionner Type Offrande :</label>
                        <select name="typeOffrande" id="typeOffrande" class="form-control form-control-lg">
                            <option value="" disabled>Séléctionner Type Offrande</option>
                            <option value="Offrande" required>Offrande</option>
                            <option value="Dime" required>Dime</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="CulteId">Sélectionner Culte:</label>
                        <select name="CulteId" id="CulteId" class="form-control form-control-lg" required>
                            <?php $req=$db->query("SELECT `idCulte`, `Culte`, `dateCulte` FROM `culte` WHERE etat=0");
                                while ($tab=$req->fetch()){?>
                                    <option value="<?php echo $tab['idCulte'];?>"><?php echo $tab['Culte'];?> | <?php echo $tab['dateCulte'];?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addOffrandes" class="btn btn-info btn-block btn-lg" id="addOffrandesBtn" value="Ajouter Offrande" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin d'Ajout Offrandes-->
<!--Début d'Edit Offrande-->
<div class="modal fade" id="EditOffrandeModal">
    <div class="modal-dialog modal-dialog-justify col-lg-16">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-light"><i class="fas fa-money-check-alt"></i>&nbsp;Modifier Offrande</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="edit-offrande-form" class="px-3">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="montantOffrande">Entrer Montant Offrande:</label>
                        <input type="number" name="montantOffrande" id="emontantOffrande" class="form-control form-control-lg" placeholder="Entrer montant Offrande" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="typeOffrande">Séléctionner Type Offrande :</label>
                        <select name="typeOffrande" id="etypeOffrande" class="form-control form-control-lg">
                            <option value="" disabled>Séléctionner Type Offrande</option>
                            <option value="Offrande" required>Offrande</option>
                            <option value="Dime" required>Dime</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="CulteId">Sélectionner Culte:</label>
                        <select name="CulteId" id="eCulteId" class="form-control form-control-lg" required>
                            <?php $req=$db->query("SELECT `idCulte`, `Culte`, `dateCulte` FROM `culte`");
                                while ($tab=$req->fetch()){?>
                                    <option value="<?php echo $tab['idCulte'];?>"><?php echo $tab['Culte'];?> | <?php echo $tab['dateCulte'];?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="editOffrandes" class="btn btn-success btn-block btn-lg" id="editOffrandesBtn" value="Modifier Offrande" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin d'Edit Offrandes-->
<!--Début depot Offrande-->
<div class="modal fade" id="depotOffrandesModal">
    <div class="modal-dialog modal-dialog-justify col-lg-16">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h4 class="modal-title text-light"><i class="fas fa-money-check-alt"></i>&nbsp;Depot Offrande</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="depot-offrande-form" class="px-3">
                    <div class="form-group">
                        <label for="depot">Séléctionner Opération Offrande :</label>
                        <select name="depot" id="depot" class="form-control form-control-lg">
                            <option value="" disabled>Séléctionner depot Offrande</option>
                            <option value="1" required>Dépôt</option>
                            <option value="O" required>Pas Dépôt</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idOffrande">Sélectionner Offrande:</label>
                        <select name="idOffrande" id="idOffrande" class="form-control form-control-lg" required>
                            <?php $req=$db->query("SELECT `idOffrande`, `typeOffrande`, `montantOffrande`, `dateOffrande`, `CulteId`, `depot`, `garder`,culte.Culte as Culte, culte.dateCulte Datee FROM `offrande` INNER JOIN culte ON culte.idCulte=offrande.CulteId WHERE depot=0");
                                while ($tab=$req->fetch()){?>
                                    <option value="<?php echo $tab['idOffrande'];?>"><?php echo $tab['typeOffrande'];?>|<?php echo $tab['Datee'];?>|<?php echo $tab['Culte'];?>|<?php echo $tab['montantOffrande'];?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="depotOffrandes" class="btn btn-secondary btn-block btn-lg" id="depotOffrandesBtn" value="Depot Offrande" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin depot Offrandes-->
<?php
    require_once 'footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){

        //Ajouter Offrande en Ajax Request
        $("#addOffrandesBtn").click(function(e){
            if($("#add-offrande-form")[0].checkValidity()){
                e.preventDefault();
                $("#addOffrandesBtn").val('Veuillez patienter...');
                $.ajax({
                    url:'processUser.php',
                    method:'post',
                    data:$("#add-offrande-form").serialize()+'&action=createOffrande',
                    success:function(response){ 
                        $("#addOffrandesBtn").val('Ajouter Offrande');
                        $("#add-offrande-form")[0].reset();
                        $("#addOffrandesModal").modal('hide');
                        Swal.fire({
                            title:'Offrande ajoutée avec succès !',
                            type:'success'
                        });
                        //Fetch All offrandes Ajax Request
                        afficherOffrandes();
                    }
                });
            }
        });

        //Fetch All Services Ajax Request
        afficherOffrandes();

        function afficherOffrandes(){
            $.ajax({
                url:'processUser.php',
                method: 'post',
                data:{action: 'afficherOffrandes'},
                success:function(response){
                    $("#afficherOffrandes").html(response);
                    $("table").DataTable({
                        order:[0, 'desc']
                    });
                }
            });
        }

         //Voir les details des offrandes avec ajax
         $("body").on("click",".infooffrandeBtn", function(e){
                e.preventDefault();

                infooffrande_id=$(this).attr('id');
                $.ajax({
                    url:'processUser.php',
                    method:'post',
                    data:{infooffrande_id:infooffrande_id},
                    success:function(response){
                        data=JSON.parse(response);
                        Swal.fire({
                            title:'<strong>Offrande :ID('+data.idOffrande+')</strong>',
                            type:'info',
                            html:'<div class="col-lg-10 text-justify"><b>Type Offrande :</b>'+data.typeOffrande+'</br></br><b>Montant Offrande:</b>'+data.montantOffrande+'</br></br><b>Date Enreg. Offrande:</b>'+data.dateOffrande+'</br></br><b>Culte Offrande:</b>'+data.Culte+'</br></br><b>Date Culte:</b>'+data.Datee+'</br></br><b>Depot: </b>'+data.depot,
                        });
                    }
                });
        });

        //Editer Offrande en Ajax request
        $("body").on("click",".editOffrandeBtn", function(e){
            e.preventDefault();

            editoffrande_id=$(this).attr('id');
            $.ajax({
                    url:'processUser.php',
                    method:'post',
                    data:{editoffrande_id:editoffrande_id},
                    success:function(response){
                        data=JSON.parse(response);
                        $("#id").val(data.idOffrande);
                        $("#etypeOffrande").val(data.typeOffrande);
                        $("#emontantOffrande").val(data.montantOffrande);
                        $("#eCulteId").val(data.CulteId);
                    }
                });
                
        });

         //Modifier Offrande en Ajax Request
         $("#editOffrandesBtn").click(function(e){
                if($("#edit-offrande-form")[0].checkValidity()){
                    e.preventDefault();

                    $.ajax({
                        url:'processUser.php',
                        method:'post',
                        data:$("#edit-offrande-form").serialize()+"&action=update_offrande",
                        success:function(response){
                            Swal.fire({
                                title:'Offrande mise à jour avec succès !',
                                type:'success'
                            });
                            $("#edit-offrande-form")[0].reset();
                            $("#EditOffrandeModal").modal('hide');
                            afficherOffrandes();
                        }
                    });
                }
        });

        //Supprimer offrande
        $("body").on("click", ".deleteOffrandeIcon", function(e){
                e.preventDefault();

                supprimer_offrande=$(this).attr('id');

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
                            data:{supprimer_offrande:supprimer_offrande},
                            success:function(response){
                                Swal.fire(
                                    'Supprimer Offrande !',
                                    'Offrande supprimée avec succès.',
                                    'success'
                                )
                                afficherOffrandes();
                            } 
                        });
                        
                    }
                })

        });

        //Depot Offrande en Ajax Request
        $("#depotOffrandesBtn").click(function(e){
            if($("#depot-offrande-form")[0].checkValidity()){
                e.preventDefault();
                $("#depotOffrandesBtn").val('Veuillez patienter...');
                $.ajax({
                    url:'processUser.php',
                    method:'post',
                    data:$("#depot-offrande-form").serialize()+'&action=depotOffrande',
                    success:function(response){ 
                        $("#depotOffrandesBtn").val('Depot Offrande');
                        $("#depot-offrande-form")[0].reset();
                        $("#depotOffrandesModal").modal('hide');
                        Swal.fire({
                            title:'Offrande déposée avec succès !',
                            type:'success'
                        });
                        //Fetch All offrandes Ajax Request
                        afficherOffrandes();
                    }
                });
            }
        });

    });
</script>
</body>
</html>