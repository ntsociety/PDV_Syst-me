<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pdv-systeme/admin/inc/ctx-head.php';


$paraId = checkParametId('id');
if (is_numeric($paraId)) {
    $produitId = $paraId;
    $produit = getById("produits", $produitId);
    if ($produit['status'] == 200) {
        $deleteProduit = destroy('produits', $produitId);

        if ($deleteProduit) {
            if ($produit['data']['image'] != "") {
                $imagePath = $_SERVER['DOCUMENT_ROOT'] . "/pdv-systeme/admin/assets/produits/" . $produit['data']['image'];
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            redirect("produits/produits", "Produit supprimé avec succès !");
        } else {
            redirect("produits/produits", "Quelques choses s'est mal passés", false);
        }
    } else {

        redirect("produits/produits", "Quelques choses s'est mal passés", false);
    }
} else {
    redirect("produits/produits", "Quelques choses s'est mal passés id $paraId", false);
}
