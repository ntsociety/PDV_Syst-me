<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pdv-systeme/admin/inc/ctx-head.php';
?>
<!-- content -->

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Modifier Client
                <a href="<?= $adminBase ?>supliers" class="btn btn-danger float-end">Retour</a>
            </h4>
        </div>
        <div class="card-body">
            <div class="table-responsiver">
                <?php alertMessage();
                if (isset($_GET['id'])) {
                    if ($_GET['id'] != "") {
                        $suplierId = $_GET['id'];
                        $suplierData = getById("supliers", $suplierId);
                        if ($suplierData) {
                            if ($suplierData['status'] == 200) {
                ?>
                                <form action="code.php" method="post">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="">Nom *</label>
                                            <input type="text" name="name" value="<?= $suplierData['data']['name'] ?>" required id="" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Email</label>
                                            <input type="email" name="email" value="<?= $suplierData['data']['email'] ?>" required id="" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Téléphone *</label>
                                            <input type="number" name="phone" required value="<?= $suplierData['data']['phone'] ?>" id="" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Adresse</label>
                                            <input type="text" name="adresse" value="<?= $suplierData['data']['adresse'] ?>" id="" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Statut (Coché = invisible et non coché = visible)</label><br>
                                            <input type="checkbox" name="status" <?= $suplierData['data']['status'] == true ? 'checked' : '' ?> style="height: 30px; width: 30px;">
                                        </div>
                                        <input type="hidden" name="id" value="<?= $suplierData['data']['id'] ?>">
                                        <div class="col-md-12 mb-3 text-end">
                                            <button class="btn btn-primary" name="update" type="submit">Modifier</button>
                                        </div>
                                    </div>
                                </form>
                <?php

                            } else {
                                echo '<h5>' . $suplierData['message'] . '</h5>';
                                return false;
                            }
                        } else {
                            echo '<h5>Quelques choses s\'est mal passés</h5>';
                            return false;
                        }
                    } else {
                        echo '<h5>Pas de Id trouvé</h5>';
                        return false;
                    }
                } else {
                    echo '<h5>Pas de Id donné</h5>';
                    return false;
                }


                ?>


            </div>
        </div>
    </div>




</div>

<!-- fin -->