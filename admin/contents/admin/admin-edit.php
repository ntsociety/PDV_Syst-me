<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pdv-systeme/admin/inc/ctx-head.php';
?>
<!-- content -->

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Modifier Admins
                <a href="<?= $adminBase ?>admins" class="btn btn-danger float-end">Retour</a>
            </h4>
        </div>
        <div class="card-body">
            <div class="table-responsiver">
                <?php alertMessage();
                if (isset($_GET['id'])) {
                    if ($_GET['id'] != "") {
                        $adminId = $_GET['id'];
                        $adminData = getById("admins", $adminId);
                        if ($adminData) {
                            if ($adminData['status'] == 200) {
                ?>
                                <form action="code.php" method="post">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="">Nom *</label>
                                            <input type="text" name="name" value="<?= $adminData['data']['name'] ?>" required id="" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Email *</label>
                                            <input type="email" name="email" value="<?= $adminData['data']['email'] ?>" required id="" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Téléphone</label>
                                            <input type="number" name="phone" value="<?= $adminData['data']['phone'] ?>" id="" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Mot de passe </label>
                                            <input type="password" name="password" placeholder="***************" id="" class="form-control">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">Is Ban</label><br>
                                            <input type="checkbox" name="is_ban" <?= $adminData['data']['is_ban'] == true ? 'checked' : '' ?> style="height: 30px; width: 30px;">
                                        </div>
                                        <input type="hidden" name="id" value="<?= $adminData['data']['id'] ?>">
                                        <div class="col-md-12 mb-3 text-end">
                                            <button class="btn btn-primary" name="updateAdmin" type="submit">Modifier</button>
                                        </div>
                                    </div>
                                </form>
                <?php

                            } else {
                                echo '<h5>' . $adminData['message'] . '</h5>';
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