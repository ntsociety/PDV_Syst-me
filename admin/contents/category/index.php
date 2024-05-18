<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pdv-systeme/admin/inc/ctx-head.php';
?>
<!-- content -->

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Categories
                <a href="<?= $adminBase ?>category/create" class="btn btn-primary float-end">Ajouter Catégorie</a>
            </h4>
        </div>
        <div class="card-body">
            <?php
            alertMessage() ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $categories = getAll("categories");
                        if (mysqli_num_rows($categories) > 0) :
                            foreach ($categories as $item) :

                        ?>
                                <tr>
                                    <td><?= $item['id'] ?></td>
                                    <td><?= $item['name'] ?></td>
                                    <?php
                                    if ($item['status']) : ?>
                                        <td> <span class="badge bg-danger rounded-2 text-white">Invisible</span></td>
                                    <?php else : ?>
                                        <td><span class="badge bg-primary rounded-2 text-white">Visible</span></td>
                                    <?php endif ?>
                                    <td class="d-flex column-gap-2">
                                        <a href="<?= $adminBase ?>category/edit?id=<?= $item['id'] ?>" class="btn btn-primary">Modifier</a>
                                        <a href="<?= $adminBase ?>category/delete?id=<?= $item['id'] ?>" onclick="return confirm('Voulez-vous le supprimer ?')" class="btn btn-danger">Supprimer</a>
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