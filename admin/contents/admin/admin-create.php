<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pdv-systeme/admin/inc/ctx-head.php';
?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Ajouter Admins
                <a href="<?= $adminBase ?>admins" class="btn btn-danger float-end">Retour</a>
            </h4>
        </div>
        <div class="card-body">
            <div class="table-responsiver">
                <?php alertMessage() ?>
                <form action="code.php" method="post">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="">Nom *</label>
                            <input type="text" name="name" required id="" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Email *</label>
                            <input type="email" name="email" required id="" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Téléphone</label>
                            <input type="number" name="phone" id="" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Mot de passe *</label>
                            <input type="password" name="password" placeholder="***************" required id="" class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="">Is Ban</label><br>
                            <input type="checkbox" name="is_ban" style="height: 30px; width: 30px;">
                        </div>
                        <div class="col-md-12 mb-3 text-end">
                            <button class="btn btn-primary" name="saveAdmins" type="submit">Ajouter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>




</div>