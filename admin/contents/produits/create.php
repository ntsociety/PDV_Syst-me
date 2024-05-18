<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pdv-systeme/admin/inc/ctx-head.php';
?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Ajouter Produit
                <a href="<?= $adminBase ?>produits" class="btn btn-danger float-end">Retour</a>
            </h4>
        </div>
        <div class="card-body">
            <div class="table-responsiver">
                <?php alertMessage() ?>
                <form action="code.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Catégorie</label>
                            <select name="category_id" id="" class="form-select">
                                <option value="" selected>Sélectionez la catégorie</option>
                                <?php
                                $category = getAll("categories");
                                if (mysqli_num_rows($category) > 0) :
                                    foreach ($category as $item) :

                                ?>
                                        <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                                    <?php
                                    endforeach; ?>

                                <?php else : ?>
                                    <option value="" disabled>Pas de catégorie</option>
                                <?php
                                endif;

                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Fournisseur</label>
                            <select name="suplier_id" id="" class="form-select">
                                <option value="" selected>Sélectionez le Fournisseur</option>
                                <?php
                                $supliers = getAll("supliers");
                                if (mysqli_num_rows($supliers) > 0) :
                                    foreach ($supliers as $item) :

                                ?>
                                        <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                                    <?php
                                    endforeach; ?>

                                <?php else : ?>
                                    <option value="" disabled>Pas de Fournisseur</option>
                                <?php
                                endif;

                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Nom *</label>
                            <input type="text" name="name" required id="" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Prix *</label>
                            <input type="text" name="prix" required id="" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control" rows="3" id=""></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Quantité *</label>
                            <input type="number" name="quantity" required id="" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Image</label>
                            <input type="file" name="image" id="" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Statut (Coché = invisible et non coché = visible)</label><br>
                            <input type="checkbox" name="is_ban" style="height: 30px; width: 30px;">
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