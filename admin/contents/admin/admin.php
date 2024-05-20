<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pdv-systeme/admin/inc/ctx-head.php';
?>
<!-- content -->

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <?php alertMessage() ?>
            <h4 class="mb-0">Admins/Staff
                <a href="/pdv-systeme/admin/admin-create" class="btn btn-primary float-end">Ajouter Admin</a>
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
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $admns = getAll("admins");
                        if (mysqli_num_rows($admns) > 0) :
                            foreach ($admns as $admin) :

                        ?>
                                <tr>
                                    <td><?= $admin['id'] ?></td>
                                    <td><?= $admin['name'] ?></td>
                                    <td><?= $admin['email'] ?></td>
                                    <td class="d-flex gap-2">
                                        <a href="<?= $adminBase ?>admin-edit?id=<?= $admin['id'] ?>" class="btn btn-primary">Modifier</a>
                                        <a href="<?= $adminBase ?>admin-delete?id=<?= $admin['id'] ?>" onclick="return confirm('Voulez-vous le supprimer ?')" class="btn btn-danger">Supprimer</a>
                                    </td>
                                </tr>
                            <?php
                            endforeach; ?>

                        <?php else : ?>
                            <tr>
                                <td colspan="4" class="text-center">Pas de données</td>
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