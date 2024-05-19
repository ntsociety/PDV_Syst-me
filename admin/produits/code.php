<?php
include "../../config/function.php";




// update


if (isset($_POST['update'])) {
    $produitId = validate($_POST['id']);
    $produitData = getById("produits", $produitId);
    if ($produitData['status'] != 200) {
        redirect("produits", "Veillez donner l'id", false);
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
        $imageName = date('Y-m-d') . '_' . $_FILES["image"]["name"];
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

            redirect('produits', "Produit Modifié avec succès !");
        } else {
            redirect('produits/edit?id=' . $produitId, "Quelques choses s'est mal passés.", false);
        }
    } else {
        redirect('produits/edit?id=' . $produitId, "Veillez renseignez les champs nécessaires. ", false);
    }
}
// produit create
if (isset($_POST['save'])) {
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $prix = validate($_POST['prix']);
    $quantity = validate($_POST['quantity']);
    $category_id = validate($_POST['category_id']);
    $suplier_id = validate($_POST['suplier_id']);

    $status = isset($_POST['status']) == true ? 1 : 0;

    if (isset($_FILES['image']) && $_FILES["image"]['size'] > 0) {

        $tmp = $_FILES["image"]["tmp_name"];
        $imageName = date('Y-m-d') . '_' . $_FILES["image"]["name"];
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
        $imageName = "";
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

        $result = insert('produits', $data);
        if ($result) {
            if ($imageName != "") {
                move_uploaded_file($tmp, $folder);
            }

            redirect('produits', "Produit ajouté avec succès !");
        } else {
            redirect('produits/create', "Quelques choses s'est mal passés.", false);
        }
    } else {
        redirect('produits/create', "Veillez renseignez les champs nécessaires. ", false);
    }
}
