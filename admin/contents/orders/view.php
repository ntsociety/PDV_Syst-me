<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pdv-systeme/admin/inc/ctx-head.php';
if (!isset($_GET['track']) || empty($_GET['track'])) {
    header("location: " . $adminBase . "orders");
}
?>
<!-- content -->


<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Voir Commande
                <a href="<?= $adminBase ?>orders/view-print?track=<?= $_GET['track'] ?>" class="btn btn-info mx-2 btn-sm float-end">Imprimer</a>
                <a href="<?= $adminBase ?>orders" class="btn btn-primary btn-sm float-end">Retour</a>
            </h4>
        </div>
        <div class="card-body">
            <?php
            alertMessage(); ?>
            <?php
            $tracking_no = $_GET['track'];
            $orders_query = "SELECT o.*, c.* from orders o, customers c 
            where c.id=o.client_id and tracking_no = '$tracking_no' order by o.id";
            $orders = mysqli_query($db_connect, $orders_query);
            if (mysqli_num_rows($orders) > 0) :
                $orderData = mysqli_fetch_assoc($orders);
                $orderId = $orderData['id']; ?>

                <div class="card card-body shadow border-1 mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Détails de la commande</h4>
                            <label for="" class="mb-1">
                                Tracking N° : <span class="fw-bold"><?= $orderData['tracking_no']; ?></span>
                            </label>
                            <label for="" class="mb-1">
                                Date de la commande : <span class="fw-bold"><?= date('Y-m-d', strtotime($orderData['date_commande']))  ?></span>
                            </label>
                            <label for="" class="mb-1">
                                Statut de la commande : <span class="fw-bold"><?= $orderData['status_commande']  ?></span>
                            </label>
                            <label for="" class="mb-1">
                                Methode de payement : <span class="fw-bold"><?= $orderData['payement_mod']  ?></span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <h4>Détail d'utilisateur</h4>
                            <label for="" class="mb-1">
                                Nom Complet : <span class="fw-bold"><?= $orderData['name']; ?></span>
                            </label>
                            <label for="" class="mb-1">
                                Téléphone : <span class="fw-bold"><?= $orderData['phone']; ?></span>
                            </label>
                            <label for="" class="mb-1">
                                Email : <span class="fw-bold"><?= $orderData['email']; ?></span>
                            </label>

                        </div>
                    </div>
                </div>

            <?php else : ?>
                <p colspan="4" class="text-center">Pas de données</p>
            <?php
            endif;

            ?>
            <?php
            $orderItemsQuery = "SELECT oi.quantity as orderItemsQty, oi.prix as orderItemsPrice, o.*, oi.*, p.* 
                from orders o, order_items oi, produits p where oi.order_id= o.id and p.id = oi.prod_id
                and o.tracking_no= '$tracking_no'";
            $orderItems = mysqli_query($db_connect, $orderItemsQuery);
            if (mysqli_num_rows($orderItems) > 0) :

            ?>
                <h4 class="my-3">Contenu de la commande</h4>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orderItems as $item) : ?>
                            <tr>
                                <td>
                                    <img src="<?= $item['image'] != "" ? "/pdv-systeme/admin/assets/produits/" . $item['image'] : '' ?>" style="height: 50px; width:50px;" class="object-fit-cover img-fluid" alt="">
                                    <?= $item['name']; ?>
                                </td>
                                <td width="15%" class="fw-bold text-center"><?= number_format($item['orderItemsPrice'], 0); ?></td>
                                <td width="15%" class="fw-bold text-center"><?= $item['orderItemsQty']; ?></td>
                                <td width="15%" class="fw-bold text-center"><?= number_format($item['orderItemsPrice'] * $item['orderItemsQty'], 0); ?></td>
                            </tr>
                        <?php endforeach ?>
                        <tr>
                            <td class="fw-bold text-end">Prix Total</td>
                            <td colspan="3" class="fw-bold text-end"><?= number_format($item['prix_total'], 0) ?>FCFA</td>
                        </tr>
                    </tbody>
                </table>
            <?php else : ?>
                <p colspan="4" class="text-center">Pas de données</p>
            <?php
            endif;

            ?>
        </div>
    </div>




</div>

<!-- fin -->