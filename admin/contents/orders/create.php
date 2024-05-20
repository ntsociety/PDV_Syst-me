<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pdv-systeme/admin/inc/ctx-head.php';
?>

<div class="container px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Ajouter Commande
                <a href="<?= $adminBase ?>orders" class="btn btn-danger float-end">Retour</a>
            </h4>
        </div>
        <div class="card-body">
            <div class="table-responsiver">
                <?php alertMessage() ?>
                <form action="code.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="">Produit</label>
                            <select name="produit_id" class="form-select form-select-field" id="">
                                <option value="" selected>--Sélectionez le Produit</option>
                                <?php
                                $produit = getAll("produits");
                                if (mysqli_num_rows($produit) > 0) :
                                    foreach ($produit as $item) :

                                ?>
                                        <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                                    <?php
                                    endforeach; ?>

                                <?php else : ?>
                                    <option value="" disabled>Pas de produit</option>
                                <?php
                                endif;

                                ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="">Quantité *</label>
                            <input type="number" name="quantity" value="1" min="1" required id="" class="form-control">
                        </div>
                        <div class="col-md-3 mb-3 text-end"><br>
                            <button class="btn btn-primary" name="save" type="submit">Ajouter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="card mt-3">
        <div class="card-header">
            <h4 class="mb-0">Produits</h4>
        </div>
        <div class="card-body" id="produitArea">
            <?php

            if (isset($_SESSION['produitItems'])) {
                $sessionProduits = $_SESSION['produitItems'];
                if (empty($sessionProduits)) {
                    unset($_SESSION['produitItemIds']);
                    unset($_SESSION['produitItems']);
                }
            ?>
                <div id="produitContent">

                    <div class="table-responsive mb-3 text-nowrap">

                        <style>
                            .table td,
                            .table th {
                                white-space: nowrap;
                                width: 1%;
                            }
                        </style>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom du Produit</th>
                                    <th>Prix</th>
                                    <th>Quantité</th>
                                    <th>Prix Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($sessionProduits as $key => $item) :

                                ?>
                                    <tr>
                                        <td><?= $i++ ?></td>

                                        <td><?= $item['name'] ?></td>
                                        <td><?= $item['prix'] ?></td>
                                        <td>
                                            <div class="input-group qtyBox">
                                                <input type="hidden" value="<?= $item['produit_id']; ?>" class="prodId">
                                                <button class="input-group-text decrement">-</button>
                                                <input type="text" class="qty quantityInput" value="<?= $item['quantity'] ?>" id="">
                                                <button class="input-group-text increment">+</button>
                                            </div>
                                        </td>
                                        <td><?= number_format($item['prix'] * $item['quantity'], 0) ?></td>
                                        <td class="d-flex gap-2">
                                            <a href="<?= $adminBase ?>orders/item-delete?index=<?= $key ?>" class="btn btn-danger">Supprimer</a>
                                        </td>
                                    </tr>
                                <?php
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-2">
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Sélectionnez méthode de payement</label>
                                <select name="payement_mode" id="payement_mode" required class="form-select">
                                    <option value="">--Select--</option>
                                    <option value="Payement cash">Payement cash</option>
                                    <option value="Online payement">Payement en ligne</option>
                                </select>
                            </div>
                            <?php
                            ?>

                            <div class="col-md-4 mb-3">
                                <label for="">Client</label>
                                <div class="input-group">
                                    <select name="customer_id" id="customerId" class="form-select form-select-field">
                                        <option value="" selected hidden>Sélectionez le Client</option>
                                        <?php
                                        $customers = getAll("customers");

                                        if (mysqli_num_rows($customers) > 0) :
                                            foreach ($customers as $item) :

                                        ?>
                                                <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                                            <?php
                                            endforeach; ?>

                                        <?php else : ?>
                                            <option value="" disabled>Pas de Client</option>
                                        <?php
                                        endif;

                                        ?>
                                    </select>
                                    <span class="input-group-text p-0"><button class="btn btn-primary btn-sm" title="Ajouter client" id="addClient"><i class="bi bi-person-plus-fill"></i></button></span>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <br>
                                <button class="btn btn-warning w-100 proceedToPlace">procéder à la commande</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } else {
                echo '<h5> Pas de commande ajouté</h5>';
            }
            ?>
        </div>
    </div>

    <!-- add client modal -->
    <!-- Modal -->
    <div class="modal fade" id="addClientModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter client</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="">Nom du client <span class="text-danger">*</span></label>
                        <input type="text" required name="" id="c_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Numéro du client <span class="text-danger">*</span></label>
                        <input type="text" required name="" id="c_phone" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Email du client </label>
                        <input type="email" name="" id="c_email" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermé</button>
                    <button type="button" class="btn btn-primary saveClient">Ajouter</button>
                </div>
            </div>
        </div>
    </div>



</div>