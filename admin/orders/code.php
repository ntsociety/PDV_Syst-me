<?php
include "../../config/function.php";




if (!isset($_SESSION['produitItemIds'])) {
    $_SESSION['produitItemIds'] = [];
}

if (!isset($_SESSION['produitItems'])) {
    $_SESSION['produitItems'] = [];
}


if (isset($_POST['update'])) {
    $produitId = validate($_POST['id']);
    $produitData = getById("produits", $produitId);
    if ($produitData['status'] != 200) {
        redirect("produits/produits", "Veillez donner l'id", false);
    }
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $prix = validate($_POST['prix']);
    $quantity = validate($_POST['quantity']);
    $category_id = validate($_POST['category_id']);
    $suplier_id = validate($_POST['suplier_id']);

    $status = isset($_POST['status']) == true ? 1 : 0;

    if (isset($_FILES['image']) && $_FILES["image"]['size'] > 0) {



        $tmp = $_FILES["image"]["tmp_name"];
        $imageName = $_FILES["image"]["name"];
        // dossier de stockage
        $folder = $_SERVER['DOCUMENT_ROOT'] . "/pdv-systeme/admin/assets/produits/" . $imageName;
        // extension
        $fileType = pathinfo($folder, PATHINFO_EXTENSION);
        // extensions autorisées
        $allow_ext = ['jpg', 'jpeg', 'png'];
        if (!in_array($fileType, $allow_ext)) {
            $error += ['image' => 'Seule les png, jpg, jpeg sont autorisés'];
        }
        // taille
        if ($_FILES['image']['size'] > 5242880) {
            $error += ['image' => "La taille de l'image <= 5 méga"];
        }
    } else {
        if ($produitData['data']['image'] != "") {
            $imageName = $produitData['data']['image'];
        } else {
            $imageName = "";
        }
    }

    if ($name != "" && $prix != "" && $quantity != "") {
        $data = [
            'name' => $name,
            'description' => $description,
            'prix' => $prix,
            'quantity' => $quantity,
            'image' => $imageName,
            'status' => $status,
        ];
        if ($category_id != "") {
            $data += ['category_id' => $category_id];
        }
        if ($suplier_id != "") {
            $data += ['suplier_id' => $suplier_id];
        }
        $result = update('produits', $produitId, $data);
        if ($result) {
            if ($imageName != "") {
                if ($produitData['data']['image'] != "") {
                    $imagePath = $_SERVER['DOCUMENT_ROOT'] . "/pdv-systeme/admin/assets/produits/" . $produitData['data']['image'];

                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
                move_uploaded_file($tmp, $folder);
            }

            redirect('produits/produits', "Produit Modifié avec succès !");
        } else {
            redirect('produits/edit?id=' . $produitId, "Quelques choses s'est mal passés.", false);
        }
    } else {
        redirect('produits/edit?id=' . $produitId, "Veillez renseignez les champs nécessaires. ", false);
    }
}

// ajax
// save order
if (isset($_POST['saveOrder'])) {
    $customer_phone = validate($_SESSION['orderData']['client_phone']);
    $payement_mod = validate($_SESSION['orderData']['payement_mod']);
    $invoice_no = validate($_SESSION['orderData']['invoice_no']);

    $clientCheck = mysqli_query($db_connect, "SELECT * from customers where phone = '$customer_phone' limit 1");
    if ($clientCheck) {
        if (mysqli_num_rows($clientCheck) > 0) {
            $client = mysqli_fetch_assoc($clientCheck);
            if (!isset($_SESSION['produitItems'])) {
                return  jsonResponse(404, 'warning', "Pas de donnés");
            }
            $totalAmount = 0;
            foreach ($_SESSION['produitItems'] as $key => $row) {

                $totalAmount += $row['prix'] * $row['quantity'];
            }
            $data = [
                'client_id' => $client['id'],
                'tracking_no' => rand(11111, 99999),
                'invoice_no' => $invoice_no,
                'Prix_total' => $totalAmount,
                'payement_mod' => $payement_mod,
                'date_commande' => date('Y-m-d'),
                'status_commande' => 'Acheté',
                'user_id' => $_SESSION['adminLogined']['id'],
            ];
            $result = insert('orders', $data);
            $lastOrderId = mysqli_insert_id($db_connect);
            foreach ($_SESSION['produitItems'] as $produitItem) {
                $produit_id = $produitItem['produit_id'];
                $prix = $produitItem['prix'];
                $quantity = $produitItem['quantity'];

                $orderDataItems = [
                    'order_id' => $lastOrderId,
                    'prod_id' => $produit_id,
                    'prix' => $prix,
                    'quantity' => $quantity,
                ];

                $orderDataItemsQuery = insert('order_items', $orderDataItems);
                $checkProduitQtyQuery = mysqli_query($db_connect, "SELECT * from produits where id = '$produit_id'");
                $produitQtyData = mysqli_fetch_assoc($checkProduitQtyQuery);
                $totalProduitQty = $produitQtyData['quantity'] - $quantity;
                $dataQtyUpdate = [
                    'quantity' => $totalProduitQty,
                ];
                $updateProduitQty = update('produits', $produit_id, $dataQtyUpdate);
            }
            unset($_SESSION['produitItems']);
            unset($_SESSION['produitItemIds']);
            unset($_SESSION['orderData']);
            return  jsonResponse(200, 'success', "Commande ajouté avec succès!");
        } else {
            return  jsonResponse(404, 'warning', "Pas de client trouvé!");
        }
    } else {
        return  jsonResponse(500, 'warning', "Quelques choses s'est mal passé");
    }
}
// proceedToPlace
if (isset($_POST['proceedToPlace'])) {
    $customer_id = validate($_POST['customer_id']);
    $payement_mod = validate($_POST['payement_mod']);

    $clientCheck = mysqli_query($db_connect, "SELECT * from customers where id = '$customer_id' limit 1");
    if ($clientCheck) {
        if (mysqli_num_rows($clientCheck) > 0) {
            $client = mysqli_fetch_assoc($clientCheck);
            $orderData = [
                'invoice_no' => "INV" . rand(111111, 999999),
                'client_phone' => $client['phone'],
                'payement_mod' => $payement_mod,
            ];
            $_SESSION['orderData'] = $orderData;
            $_SESSION['clientData'] = $client;
            jsonResponse(200, 'success', "Client trouvé");
        } else {
            jsonResponse(404, 'warning', "Client non trouvé");
        }
    } else {
        jsonResponse(500, 'warning', "Quelques choses s'est mal passé");
    }
}
if (isset($_POST['produitIncDec'])) {
    $quantity = validate($_POST['quantity']);
    $produit_id = validate($_POST['produit_id']);
    $flag = false;
    foreach ($_SESSION['produitItems'] as $key => $item) {
        if ($item['produit_id'] == $produit_id) {
            $flag = true;
            $_SESSION['produitItems'][$key]['quantity'] = $quantity;
        }
    }
    if ($flag) {

        return jsonResponse(200, 'success', 'Quantité mise à jour');
    } else {
        return jsonResponse(500, 'warning', "Quelques choses s'est mal passé");
    }
}
// produit create
if (isset($_POST['save'])) {
    $quantity = validate($_POST['quantity']);
    $produit_id = validate($_POST['produit_id']);



    if ($quantity != "" &&  $produit_id != "") {
        $checkProduit = mysqli_query($db_connect, "SELECT * from produits where id = '$produit_id' limit 1");
        if ($checkProduit) {
            if (mysqli_num_rows($checkProduit) > 0) {
                $row = mysqli_fetch_assoc($checkProduit);
                if ($row['quantity'] < $quantity) {
                    redirect('orders/create', "Seulement " . $row['quantity'] . "quantité disponible", false);
                }
                $produitData = [
                    'produit_id' => $row['id'],
                    'name' => $row['name'],
                    'prix' => $row['prix'],
                    'quantity' => $quantity,
                    'image' => $row['image'],
                ];
                if (!in_array($row['id'], $_SESSION['produitItemIds'])) {

                    array_push($_SESSION['produitItemIds'], $row['id']);
                    array_push($_SESSION['produitItems'], $produitData);
                } else {
                    foreach ($_SESSION['produitItems'] as $key => $produitSessionItem) {
                        if ($produitSessionItem['produit_id'] == $row['id']) {
                            $newQuantity = $produitSessionItem['quantity'] + $quantity;
                            $produitData = [
                                'produit_id' => $row['id'],
                                'name' => $row['name'],
                                'prix' => $row['prix'],
                                'image' => $row['image'],
                                'quantity' => $newQuantity,
                            ];
                            $_SESSION['produitItems'][$key] = $produitData;
                        }
                    }
                    // $result = insert('orders', $produitData);
                }
                redirect('orders/create', "Commande ajouté " . $row['name']);
            } else {
                redirect('orders/create', "Pas de produit trouvé", false);
            }
        } else {
            redirect('orders/create', "Quelques choses s'est mal passé", false);
        }
    } else {
        redirect('orders/create', "Veillez renseignez les champs nécessaires. ", false);
    }
}
