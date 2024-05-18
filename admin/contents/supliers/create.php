<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pdv-systeme/admin/inc/ctx-head.php';
?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Ajouter Fournisseur
                <a href="<?= $adminBase ?>supliers" class="btn btn-danger float-end">Retour</a>
            </h4>
        </div>
        <div class="card-body">
            <div class="table-responsiver">
                <?php alertMessage() ?>
                <form action="code.php" method="post">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Nom *</label>
                            <input type="text" name="name" required id="" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Email </label>
                            <input type="email" name="email" id="" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Téléphone *</label>
                            <input type="number" name="phone" required id="" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Adresse</label>
                            <input type="text" name="adresse" id="" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Statut (Coché = invisible et non coché = visible)</label><br>
                            <input type="checkbox" name="status" style="height: 30px; width: 30px;">
                        </div>
                        <div class="col-md-12 mb-3 text-end">
                            <button class="btn btn-primary" name="save" type="submit">Ajouter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>




</div>