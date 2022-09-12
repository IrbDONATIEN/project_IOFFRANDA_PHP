<?php
    require_once 'header.php';
?>
<div class="container mt-2">
    <div class="mt-2">
        <img src="../images/logo.png">
    </div>
    <hr>
    <div class="card border-info mt-2">
            <h5 class="card-header bg-info d-flex justify-content-between">
            <span class="text-light lead align-self-center"><i class="fas fa-pen"></i>&nbsp;Tous les Cultes</span>
              <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addCultesModal"><i class="fas fa-pen"></i>&nbsp;Ajouter Culte</a>
            </h5>
        <div class="card-body">
        <div class="table-responsive" id="afficherCultes">
            <p class="text-center lead mt-5">Veuillez patienter...</p>
        </div>
    </div>
</div>
<!--Début d'Ajout Culte-->
<div class="modal fade" id="addCultesModal">
    <div class="modal-dialog modal-dialog-justify col-lg-16">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light"><i class="fas fa-pen" ></i>&nbsp;Ajouter Culte</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="add-culte-form" class="px-3">
                    <div id="egliseAlert" class="text-danger text-center mt-2 font-weight-bold"></div>
                    <div class="form-group">
                        <input type="text" name="Culte" id="Culte" class="form-control form-control-lg" placeholder="Entrer Nom Culte" required autofocus>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addCulte" class="btn btn-info btn-block btn-lg" id="addCulteBtn" value="Ajouter Culte" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin d'Ajout Culte-->
<?php
    require_once 'footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){
         //Ajouter Culte en Ajax Request
         $("#addCulteBtn").click(function(e){
            if($("#add-culte-form")[0].checkValidity()){
                e.preventDefault();
                $("#addCulteBtn").val('Veuillez patienter...');
                $.ajax({
                    url:'processAdmin.php',
                    method:'post',
                    data:$("#add-culte-form").serialize()+'&action=createCulte',
                    success:function(response){
                        $("#addCulteBtn").val('Ajouter Culte');
                        $("#add-culte-form")[0].reset();
                        $("#addCultesModal").modal('hide');
                        Swal.fire({
                            title:'Culte ajouté avec succès !',
                            type:'success'
                        });
                        //Fetch All Cultes Ajax Request
                        afficherCultes();
                        $("#culteAlert").html(response);
                    }
                });
            }
        });

        //Fetch All Cultes Ajax Request
        afficherCultes();

        function afficherCultes(){
            $.ajax({
                url:'processAdmin.php',
                method: 'post',
                data:{action: 'afficherCultes'},
                success:function(response){
                    $("#afficherCultes").html(response);
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