<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pdv-systeme/admin/inc/ctx-head.php';
?>
<!-- content -->

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Fournisseur
                <a href="/pdv-systeme/admin/supliers/create" class="btn btn-primary float-end">Ajouter</a>
            </h4>
        </div>
        <div class="card-body">
            <?php
            alertMessage() ?>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Téléphone</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $supliers = getAll("supliers");
                        if (mysqli_num_rows($supliers) > 0) :
                            foreach ($supliers as $item) :

                        ?>
                                <tr>
                                    <td><?= $item['id'] ?></td>
                                    <td><?= $item['name'] ?></td>
                                    <td><?= $item['phone'] ?></td>
                                    <td><?= $item['email'] ?></td>
                                    <td class="d-flex gap-2">
                                        <a href="<?= $adminBase ?>supliers/edit?id=<?= $item['id'] ?>" class="btn btn-primary">Modifier</a>
                                        <a href="<?= $adminBase ?>supliers/delete?id=<?= $item['id'] ?>" onclick="return confirm('Voulez-vous le supprimer ?')" class="btn btn-danger">Supprimer</a>
                                    </td>
                                </tr>
                            <?php
                            endforeach; ?>

                        <?php else : ?>
                            <tr>
                                <td colspan="5" class="text-center">Pas de données</td>
                            </tr>
                        <?php
                        endif;

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>




</div>

<!-- fin -->