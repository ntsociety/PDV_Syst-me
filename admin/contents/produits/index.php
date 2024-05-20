<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pdv-systeme/admin/inc/ctx-head.php';
?>
<!-- content -->

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Produits
                <a href="<?= $adminBase ?>produits/create" class="btn btn-primary float-end">Ajouter Produit</a>
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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $produit = getAll("produits");
                        if (mysqli_num_rows($produit) > 0) :
                            foreach ($produit as $item) :

                        ?>
                                <tr>
                                    <td><?= $item['id'] ?></td>
                                    <?php if ($item['image'] != "") :  ?>
                                        <td>
                                            <img src="<?= $adminBase ?>assets/produits/<?= $item['image'] ?>" style="height: 50px; width:100px; object-fit:contain;" class="object-fit-contain img-fluid" alt="">
                                        </td>
                                    <?php else : ?>
                                        <td>Pas d'image</td>
                                    <?php endif ?>
                                    <td><?= $item['name'] ?></td>
                                    <td><?= $item['prix'] ?></td>
                                    <td class="d-flex gap-2">
                                        <a href="<?= $adminBase ?>produits/edit?id=<?= $item['id'] ?>" class="btn btn-primary">Modifier</a>
                                        <a href="<?= $adminBase ?>produits/delete?id=<?= $item['id'] ?>" onclick="return confirm('Voulez-vous le supprimer ?')" class="btn btn-danger">Supprimer</a>
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