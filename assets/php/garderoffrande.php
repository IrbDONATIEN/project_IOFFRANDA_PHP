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
            <span class="text-light lead align-self-center"><i class="fa fa-folder"></i>&nbsp;<i class="fa fa-folder"></i>&nbsp;Toutes les Offrandes Déposées</span>
            <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#garderOffrandesModal"><i class="fas fa-money-check-alt"></i>&nbsp;Garder Offrande</a>
          </h5>
    <div class="card-body">
        <div class="table-responsive" id="affichergarderOffrandes">
            <p class="text-center lead mt-5">Veuillez patienter...</p>
        </div>
    </div>
</div>
<!--Début depot Offrande-->
<div class="modal fade" id="garderOffrandesModal">
    <div class="modal-dialog modal-dialog-justify col-lg-16">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h4 class="modal-title text-light"><i class="fas fa-money-check-alt"></i>&nbsp;Garder Offrande</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="garder-offrande-form" class="px-3">
                    <div class="form-group">
                        <label for="garder">Séléctionner Opération Garder Offrande :</label>
                        <select name="garder" id="garder" class="form-control form-control-lg">
                            <option value="" disabled>Séléctionner garder Offrande</option>
                            <option value="1" required>Garder Offrande </option>
                            <option value="O" required>Pas Garder Offrande</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idOffrande">Sélectionner Offrande Déposée:</label>
                        <select name="idOffrande" id="idOffrande" class="form-control form-control-lg" required>
                            <?php $req=$db->query("SELECT `idOffrande`, `typeOffrande`, `montantOffrande`, `dateOffrande`, `CulteId`, `depot`, `garder`,culte.Culte as Culte, culte.dateCulte Datee FROM `offrande` INNER JOIN culte ON culte.idCulte=offrande.CulteId WHERE depot=1 AND garder=0");
                                while ($tab=$req->fetch()){?>
                                    <option value="<?php echo $tab['idOffrande'];?>"><?php echo $tab['typeOffrande'];?>|<?php echo $tab['Datee'];?>|<?php echo $tab['Culte'];?>|<?php echo $tab['montantOffrande'];?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="garderOffrandes" class="btn btn-secondary btn-block btn-lg" id="garderOffrandesBtn" value="Garder Offrande" >
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
        //Fetch All depot Ajax Request
        affichergarderOffrandes();

        function affichergarderOffrandes(){
            $.ajax({
                url:'processUser.php',
                method: 'post',
                data:{action: 'affichergarderOffrandes'},
                success:function(response){
                    $("#affichergarderOffrandes").html(response);
                    $("table").DataTable({
                        order:[0, 'desc']
                    });
                }
            });
        }

        //Garder Offrande en Ajax Request
        $("#garderOffrandesBtn").click(function(e){
            if($("#garder-offrande-form")[0].checkValidity()){
                e.preventDefault();
                $("#garderOffrandesBtn").val('Veuillez patienter...');
                $.ajax({
                    url:'processUser.php',
                    method:'post',
                    data:$("#garder-offrande-form").serialize()+'&action=garderOffrande',
                    success:function(response){ 
                        $("#garderOffrandesBtn").val('Garder Offrande');
                        $("#garder-offrande-form")[0].reset();
                        $("#garderOffrandesModal").modal('hide');
                        Swal.fire({
                            title:'Offrande gardée avec succès !',
                            type:'success'
                        });
                        //Fetch All offrandes Ajax Request
                        affichergarderOffrandes();
                    }
                });
            }
        });
        

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

    });
</script>
</body>
</html>