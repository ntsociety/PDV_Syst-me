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
            <h4 class="mb-0">Imprimer Commande
                <a href="<?= $adminBase ?>orders" class="btn btn-primary float-end">Retour</a>
            </h4>
        </div>
        <div class="card-body">
            <div id="myBillingArea">
                <?php
                $tracking_no = $_GET['track'];
                $orders_query = "SELECT o.*, c.* from orders o, customers c 
                    where c.id=o.client_id and tracking_no = '$tracking_no' limit 1";
                $orders = mysqli_query($db_connect, $orders_query);
                if (mysqli_num_rows($orders) > 0) {
                    $orderData = mysqli_fetch_assoc($orders);
                    $orderId = $orderData['id'];
                    // print_r($orderData); 
                ?>

                    <table style="width: 100%; margin-bottom:20px;">
                        <tbody>
                            <tr>
                                <td class="text-center" colspan="2">
                                    <h4 style="font-size: 23px; line-height:30px; margin:2px; padding:0;">Entreprise XYZ</h4>
                                    <p style="font-size: 16px; line-height:24px; margin:2px; padding:0;">#555 hehj jjjdnn </p>
                                    <p style="font-size: 16px; line-height:24px; margin:2px; padding:0;">#555 hehj jjjdnn </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 style="font-size: 20px; line-height:30px; margin:2px; padding:0;">Client Détails</h4>
                                    <p style="font-size: 14px; line-height:24px; margin:2px; padding:0;">Nom du client <?= $orderData['name'] ?> </p>
                                    <p style="font-size: 14px; line-height:24px; margin:2px; padding:0;">Numéro du client <?= $orderData['phone'] ?> </p>
                                    <p style="font-size: 14px; line-height:24px; margin:2px; padding:0;">Email du client <?= $orderData['email'] ?></p>
                                </td>
                                <td align="end">
                                    <h4 style="font-size: 20px; line-height:30px; margin:2px; padding:0;">Détails facture</h4>
                                    <p style="font-size: 14px; line-height:24px; margin:2px; padding:0;">facture N° <?= $orderData['invoice_no'] ?> </p>
                                    <p style="font-size: 14px; line-height:24px; margin:2px; padding:0;">Date facture <?= date('Y-m-d') ?> </p>
                                    <p style="font-size: 14px; line-height:24px; margin:2px; padding:0;">Adresse 655 BB zjdj</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                <?php } else {
                    return header('location: 404');
                } ?>


                <?php
                $orderItemsQuery = "SELECT oi.quantity as orderItemsQty, oi.prix as orderItemsPrice, o.*, oi.*, p.* 
                from orders o, order_items oi, produits p where oi.order_id= o.id and p.id = oi.prod_id
                and o.tracking_no= '$tracking_no'";
                $orderItems = mysqli_query($db_connect, $orderItemsQuery);
                if (mysqli_num_rows($orderItems) > 0) {

                ?>
                    <div class="table-responsive mb-3">
                        <table style="width: 100%;" cellpadding="5">
                            <thead>
                                <tr>
                                    <th align="start" style="border-bottom:1px solid #ccc;" width="5%">ID</th>
                                    <th align="start" style="border-bottom:1px solid #ccc;">Nom du Produit</th>
                                    <th align="start" style="border-bottom:1px solid #ccc;" width="10%">Prix</th>
                                    <th align="start" style="border-bottom:1px solid #ccc;" width="10%">Quantité</th>
                                    <th align="start" style="border-bottom:1px solid #ccc;" width="10%">Prix Total</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($orderItems as $row) :

                                ?>
                                    <tr>
                                        <td style="border-bottom:1px solid #ccc;"><?= $i ?></td>
                                        <td style="border-bottom:1px solid #ccc;"><?= $row['name'] ?></td>
                                        <td style="border-bottom:1px solid #ccc;"><?= number_format($row['orderItemsPrice'], 0) ?></td>
                                        <td style="border-bottom:1px solid #ccc;"><?= $row['orderItemsQty'] ?></td>
                                        <td style="border-bottom:1px solid #ccc;">
                                            <?= number_format($row['orderItemsPrice'] * $row['orderItemsQty'], 0)  ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="4" align="end" style="font-weight:bold;">Grand Total</td>
                                    <td colspan="1" style="font-weight:bold;"><?= number_format($row['prix_total'], 0) ?></td>
                                </tr>
                                <tr>
                                    <td colspan="5">Méthode de payement: <span class="fw-bold"><?= $row['payement_mod'] ?></span> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php } else {
                    return header('location: 404');
                }
                ?>
            </div>
            <div class="mt-4 text-end">
                <button class="btn btn-info px-4 mx-1" onclick="printBillingArea()">Imprimer</button>
                <button class="btn btn-primary px-4 mx-1" onclick="downloadPDF('<?= $orderData['invoice_no'] ?>')">Télécharger</button>
            </div>

        </div>
    </div>




</div>

<!-- fin -->