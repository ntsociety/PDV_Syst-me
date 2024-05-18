<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pdv-systeme/admin/inc/ctx-head.php';
?>
<!-- content -->

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Commandes
                <a href="<?= $adminBase ?>orders/create" class="btn btn-primary float-end">Ajouter</a>
            </h4>
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
                        $orders_query = "SELECT o.*, c.* from orders o, customers c where c.id=o.client_id order by o.id";
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
                                        <a href="<?= $adminBase ?>orders/edit?id=<?= $item['id'] ?>" class="btn btn-primary">Imprimer</a>
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