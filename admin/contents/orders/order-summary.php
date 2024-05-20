<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pdv-systeme/admin/inc/ctx-head.php';

if (!isset($_SESSION['produitItems'])) {
    header("location: $adminBase" . "orders/create");
}
?>
<!-- content -->



<!-- Modal -->
<div class="modal fade" id="orderSuccessModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="mb-3 p-4">
                <h5 id="orderPlaceSuccess"></h5>
            </div>
            <div class="modal-body">
                <a href="<?= $adminBase ?>orders" class="btn btn-secondary">Fermé</a>
                <button type="button" class="btn btn-danger" onclick="printBillingArea()">Imprimer</button>
                <button type="button" class="btn btn-warning" onclick="downloadPDF('<?= $_SESSION['orderData']['invoice_no'] ?>')">Télécharger</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="mb-0">Commande Sommaire
                        <a href="<?= $adminBase ?>orders/create" class="btn btn-primary float-end">Retour</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php alertMessage() ?>
                    <div id="myBillingArea">
                        <?php
                        if (isset($_SESSION['orderData']) && isset($_SESSION['clientData'])) {
                            $phone = $_SESSION['orderData']['client_phone'];
                            $invoiceNo = $_SESSION['orderData']['invoice_no'];
                            $clientData = $_SESSION['clientData'];
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
                                            <p style="font-size: 14px; line-height:24px; margin:2px; padding:0;">Nom du client <?= $clientData['name'] ?> </p>
                                            <p style="font-size: 14px; line-height:24px; margin:2px; padding:0;">Numéro du client <?= $clientData['phone'] ?> </p>
                                            <p style="font-size: 14px; line-height:24px; margin:2px; padding:0;">Email du client <?= $clientData['email'] ?></p>
                                        </td>
                                        <td align="end">
                                            <h4 style="font-size: 20px; line-height:30px; margin:2px; padding:0;">Détails facture</h4>
                                            <p style="font-size: 14px; line-height:24px; margin:2px; padding:0;">facture N° <?= $invoiceNo ?> </p>
                                            <p style="font-size: 14px; line-height:24px; margin:2px; padding:0;">Date facture <?= date('Y-m-d') ?> </p>
                                            <p style="font-size: 14px; line-height:24px; margin:2px; padding:0;">Adresse 655 BB zjdj</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                        <?php
                        }

                        ?>

                        <?php
                        if (isset($_SESSION['produitItems'])) {
                            $sessionProduits = $_SESSION['produitItems'];
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
                                        $totalAmount = 0;
                                        foreach ($sessionProduits as $key => $row) :
                                            $totalAmount += $row['prix'] * $row['quantity'];

                                        ?>
                                            <tr>
                                                <td style="border-bottom:1px solid #ccc;"><?= $i ?></td>
                                                <td style="border-bottom:1px solid #ccc;"><?= $row['name'] ?></td>
                                                <td style="border-bottom:1px solid #ccc;"><?= number_format($row['prix'], 0) ?></td>
                                                <td style="border-bottom:1px solid #ccc;"><?= $row['quantity'] ?></td>
                                                <td style="border-bottom:1px solid #ccc;">
                                                    <?= number_format($row['prix'] * $row['quantity'], 0)  ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td colspan="4" align="end" style="font-weight:bold;">Grand Total</td>
                                            <td colspan="1" style="font-weight:bold;"><?= number_format($totalAmount, 0) ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">Méthode de payement: <?= $_SESSION['orderData']['payement_mod'] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>



                        <?php
                        }


                        ?>
                    </div>
                    <?php if (isset($_SESSION['produitItems'])) {
                    ?>
                        <div class="mt-4 text-end">
                            <button class="btn btn-primary px-4 mx-1" id="saveOrder">Enregistrer</button>
                            <button type="button" class="btn btn-danger" onclick="printBillingArea()">Imprimer</button>
                            <button type="button" class="btn btn-warning" onclick="downloadPDF('<?= $_SESSION['orderData']['invoice_no'] ?>')">Télécharger</button>
                        </div>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>



</div>

<!-- fin -->