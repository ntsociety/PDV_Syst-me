<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pdv-systeme/admin/inc/ctx-head.php';
?>
<!-- content -->

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <div class="row">
                <div class="col-md-4">
                    <h4 class="mb-0">Commandes
                        <a href="<?= $adminBase ?>orders/create" class="btn btn-primary btn-sm float-end">Ajouter</a>
                    </h4>
                </div>
                <div class="col-md-8">
                    <form action="" method="GET">
                        <div class="row g-1">
                            <div class="col-md-4">
                                <input type="date" class="form-control" name="date" value="<?= isset($_GET['date']) == true ? $_GET['date'] : '' ?>" id="">
                            </div>
                            <div class="col-md-4">
                                <select name="payement_method" class="form-select" id="">
                                    <option value="">Select Payement Méthode</option>
                                    <option value="Payement cash" <?= isset($_GET['payement_method']) == true ? ($_GET['payement_method'] == 'Payement cash' ? 'selected' : '') : '' ?>>
                                        Payement Cash</option>
                                    <option value="online_payement" <?= isset($_GET['payement_method']) == true ? ($_GET['payement_method'] == 'online_payement' ? 'selected' : '') : '' ?>>Payement En ligne</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-sm">Filtrer</button>
                                <a href="<?= $adminBase ?>orders" class="btn btn-danger btn-sm">Restaurer</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <?php
            alertMessage() ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered justify-content-center align-items-center">
                    <thead>
                        <tr>
                            <th>Tracking N°</th>
                            <th>Nom du client</th>
                            <th>Numéro du client</th>
                            <th>Date de commande</th>
                            <th>Statut de commande</th>
                            <th>Méthode de Payement</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        if (isset($_GET['date']) || isset($_GET['payement_method'])) {
                            $orderDate = validate($_GET['date']);
                            $payementMethod = validate($_GET['payement_method']);
                            if ($orderDate != "" && $payementMethod == "") {
                                $orders_query = "SELECT o.*, c.* from orders o, customers c 
                                where c.id=o.client_id and o.date_commande ='$orderDate'  order by o.id";
                            } elseif ($orderDate == "" && $payementMethod != "") {
                                $orders_query = "SELECT o.*, c.* from orders o, customers c 
                                where c.id=o.client_id and o.payement_mod ='$payementMethod'  order by o.id";
                            } elseif ($orderDate != "" && $payementMethod != "") {
                                $orders_query = "SELECT o.*, c.* from orders o, customers c 
                                where c.id=o.client_id and o.date_commande ='$orderDate' and o.payement_mod ='$payementMethod'  order by o.id";
                            } else {
                                $orders_query = "SELECT o.*, c.* from orders o, customers c where c.id=o.client_id order by o.id";
                            }
                        } else {
                            $orders_query = "SELECT o.*, c.* from orders o, customers c where c.id=o.client_id order by o.id";
                        }
                        $orders = mysqli_query($db_connect, $orders_query);
                        if (mysqli_num_rows($orders) > 0) :
                            foreach ($orders as $item) :

                        ?>
                                <tr>
                                    <td><?= $item['tracking_no'] ?></td>

                                    <td><?= $item['name'] ?></td>
                                    <td><?= $item['phone'] ?></td>
                                    <td><?= date('Y-m-d', strtotime($item['date_commande']))  ?></td>
                                    <td><?= $item['status_commande'] ?></td>
                                    <td><?= $item['payement_mod'] ?></td>
                                    <td class="d-flex gap-2">
                                        <a href="<?= $adminBase ?>orders/view?track=<?= $item['tracking_no'] ?>" class="btn btn-info">Voir</a>
                                        <a href="<?= $adminBase ?>orders/view-print?track=<?= $item['tracking_no'] ?>" class="btn btn-primary">Imprimer</a>
                                    </td>
                                </tr>
                            <?php
                            endforeach; ?>

                        <?php else : ?>
                            <tr>
                                <td colspan="7" class="text-center">Pas de données</td>
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