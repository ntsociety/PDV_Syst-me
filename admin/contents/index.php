<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pdv-systeme/admin/inc/ctx-head.php';
?>


<div class="container-fluid px-4">

    <div class="row">
        <div class="col-md-12">
            <h1 class="mt-4">Dashboard</h1>

            <?php
            alertMessage() ?>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-body bg-primary text-white p-3">
                <p class="text-sm mb-0 text-capitalize">Total Catégorie</p>
                <h5 class="fw-bold mb-0">
                    <?= getCount('categories') ?>
                </h5>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-body bg-info p-3">
                <p class="text-sm mb-0 text-capitalize">Total Fournisseur</p>
                <h5 class="fw-bold mb-0">
                    <?= getCount('supliers') ?>
                </h5>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-body bg-primary text-white p-3">
                <p class="text-sm mb-0 text-capitalize">Total Produit</p>
                <h5 class="fw-bold mb-0">
                    <?= getCount('produits') ?>
                </h5>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-body bg-info p-3">
                <p class="text-sm mb-0 text-capitalize">Total Staff</p>
                <h5 class="fw-bold mb-0">
                    <?= getCount('admins') ?>
                </h5>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-body bg-info p-3">
                <p class="text-sm mb-0 text-capitalize">Total Client</p>
                <h5 class="fw-bold mb-0">
                    <?= getCount('customers') ?>
                </h5>
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <hr>
            <h5>Commandes</h5>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-body bg-warning  p-3">
                <p class="text-sm mb-0 text-capitalize">Commande Aujourd'hui</p>
                <h5 class="fw-bold mb-0">
                    <?php
                    $todayDate = date('Y-m-d');
                    $todayOrder = mysqli_query($db_connect, "SELECT * from orders where date_commande = '$todayDate'");
                    if ($todayDate) {
                        echo mysqli_num_rows($todayOrder);
                    }
                    ?>
                </h5>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-body bg-warning p-3">
                <p class="text-sm mb-0 text-capitalize">Total Commandes</p>
                <h5 class="fw-bold mb-0">
                    <?= getCount('orders') ?>
                </h5>
            </div>
        </div>

    </div>

</div>