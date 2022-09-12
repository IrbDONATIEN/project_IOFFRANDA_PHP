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
            <span class="text-light lead align-self-center"><i class="fas fa-business-time"></i>&nbsp;Toutes les Depenses</span>
            <a href="#" class="btn btn-light" data-toggle="modal" data-target="#depenseOffrandesModal"><i class="fas fa-business-time"></i>&nbsp;Repertorier Depense</a>
          </h5>
    <div class="card-body">
        <div class="table-responsive" id="afficherdepenseOffrandes">
            <p class="text-center lead mt-5">Veuillez patienter...</p>
        </div>
    </div>
    </div>
<!--Début depense Offrande-->
<div class="modal fade" id="depenseOffrandesModal">
    <div class="modal-dialog modal-dialog-justify col-lg-16">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-light"><i class="fas fa-business-time"></i>&nbsp;Repertorier Depense</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="depense-offrande-form" class="px-3">
                   <div class="form-group">
                        <label for="destineDepense">Entrer Destine depense:</label>
                        <input type="text" name="destineDepense" id="destineDepense" class="form-control form-control-lg" placeholder="Entrer Destine depense" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="motifDepense">Entrer Motif depense:</label>
                        <input type="text" name="motifDepense" id="motifDepense" class="form-control form-control-lg" placeholder="Entrer Motif depense">
                    </div>
                    <div class="form-group">
                        <label for="montantDepense">Entrer Montant depense:</label>
                        <input type="number" name="montantDepense" id="montantDepense" class="form-control form-control-lg" placeholder="Entrer Montant depense">
                    </div>
                    <div class="form-group">
                        <label for="idOffrande">Sélectionner Offrande:</label>
                        <select name="idOffrande" id="idOffrande" class="form-control form-control-lg" required>
                            <?php $req=$db->query("SELECT `idOffrande`, `typeOffrande`,`montantOffrande`, `dateOffrande`, `CulteId`, `depot`, `garder` FROM `offrande` WHERE depot=1 AND garder=1");
                                while ($tab=$req->fetch()){?>
                                    <option value="<?php echo $tab['idOffrande'];?>"><?php echo $tab['typeOffrande'];?>|<?php echo $tab['dateOffrande'];?>|<?php echo $tab['montantOffrande'];?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="DemandeId">Sélectionner Demande depense:</label>
                        <select name="DemandeId" id="DemandeId" class="form-control form-control-lg" required>
                            <?php $req=$db->query("SELECT `idDemande`, `Description`, `motifDemande`, `dateDemande`, `ServiceId`, service.Service as Service,`demandeExec` FROM `demande` INNER JOIN service ON service.idService=demande.ServiceId WHERE demandeExec=0");
                                while ($tab=$req->fetch()){?>
                                    <option value="<?php echo $tab['idDemande'];?>"><?php echo $tab['Service'];?>|<?php echo $tab['motifDemande'];?>|<?php echo $tab['Description'];?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idRapport">Sélectionner Rapport Mois:</label>
                        <select name="idRapport" id="idRapport" class="form-control form-control-lg" required>
                            <?php $req=$db->query("SELECT `idRapport`, SUM(`Entree`) as MontantEntre,SUM(`Sortie`) as MontantSortie, `Offrande_type`, `dateRapport` FROM `rapport` GROUP BY Offrande_type,dateRapport");
                                while ($tab=$req->fetch()){?>
                                    <option value="<?php echo $tab['idRapport'];?>"><?php echo $tab['Offrande_type'];?>|<?php echo $tab['dateRapport'];?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="depenseOffrandes" class="btn btn-primary btn-block btn-lg" id="depenseOffrandesBtn" value="Repertorier Depense" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin depense Offrandes-->
<?php
    require_once 'footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){

        //Ajouter depense Offrande en Ajax Request
        $("#depenseOffrandesBtn").click(function(e){
            if($("#depense-offrande-form")[0].checkValidity()){
                e.preventDefault();
                $("#depenseOffrandesBtn").val('Veuillez patienter...');
                $.ajax({
                    url:'processUser.php',
                    method:'post',
                    data:$("#depense-offrande-form").serialize()+'&action=createdepenseOffrande',
                    success:function(response){ 
                        $("#depenseOffrandesBtn").val('Repertorier Offrande');
                        $("#depense-offrande-form")[0].reset();
                        $("#depenseOffrandesModal").modal('hide');
                        Swal.fire({
                            title:'Depense Offrande ajoutée avec succès !',
                            type:'success'
                        });
                        //Fetch All depense offrandes Ajax Request
                        afficherdepenseOffrandes();
                    }
                });
            }
        });


         //Fetch All Services Ajax Request
         afficherdepenseOffrandes();

        function afficherdepenseOffrandes(){
            $.ajax({
                url:'processUser.php',
                method: 'post',
                data:{action: 'afficherdepenseOffrandes'},
                success:function(response){
                    $("#afficherdepenseOffrandes").html(response);
                    $("table").DataTable({
                        order:[0, 'desc']
                    });
                }
            });
        }

    });
</script>
</body>
</html>