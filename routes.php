<?php
// Ce script gère toutes les requêtes pour les pages admin

// Obtenez le chemin de l'URL demandée
$request_uri = $_SERVER['REQUEST_URI'];
$id = 0;
$index = 0;
$track = "";
if (isset($_GET['index'])) {
    $index = $_GET['index'];
}
if (isset($_GET['track'])) {
    $track = $_GET['track'];
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
// Vous pouvez ensuite analyser l'URL demandée et inclure le contenu approprié
// par exemple :
$adminBase = "/pdv-systeme/admin";
switch ($request_uri) {

        // commande
    case "$adminBase/orders/delete?id=$id":
        include 'admin/orders/delete.php';
        break;
    case "$adminBase/orders/view?track=$track":
        include 'admin/orders/view.php';
        break;
    case "$adminBase/orders/order-summary":
        include 'admin/orders/order-summary.php';
        break;
    case "$adminBase/orders/item-delete?index=$index":
        include 'admin/orders/item-delete.php';
        break;
    case "$adminBase/orders/edit?id=$id":
        include 'admin/orders/edit.php';
        break;
    case "$adminBase/orders/create":
        include 'admin/orders/create.php';
        break;

        // produit
    case "$adminBase/produits/delete?id=$id":
        include 'admin/produits/delete.php';
        break;
    case "$adminBase/produits/edit?id=$id":
        include 'admin/produits/edit.php';
        break;
    case "$adminBase/produits/create":
        include 'admin/produits/create.php';
        break;
    case "$adminBase/produits":
        include 'admin/produits';
        break;
        // Category
    case "$adminBase/category/delete?id=$id":
        include 'admin/category/delete.php';
        break;
    case "$adminBase/category/edit?id=$id":
        include 'admin/category/edit.php';
        break;
    case "$adminBase/category/create":
        include 'admin/category/create.php';
        break;
    case "$adminBase/category":
        include 'admin/category';
        break;

        // client
    case "$adminBase/clients/delete?id=$id":
        include 'admin/clients/delete.php';
        break;
    case "$adminBase/clients/edit?id=$id":
        include "admin/clients/edit.php";
        break;
    case "$adminBase/clients/create":
        include 'admin/clients/create.php';
        break;
    case "$adminBase/clients":
        include 'admin/clients';
        break;
        // supliers
    case "$adminBase/supliers/delete?id=$id":
        include 'admin/supliers/delete.php';
        break;
    case "$adminBase/supliers/edit?id=$id":
        include "admin/supliers/edit.php";
        break;
    case "$adminBase/supliers/create":
        include 'admin/supliers/create.php';
        break;
    case "$adminBase/supliers":
        include 'admin/supliers';
        break;
        // admin
    case "$adminBase/admin-delete?id=$id":
        include 'admin/admin-delete.php';
        break;
    case "$adminBase/admin-edit?id=$id":
        include "admin/admin-edit.php";
        break;
    case "$adminBase/admin-create":
        include 'admin/admin-create.php';
        break;
    case "$adminBase/admins":
        include 'admin/admins.php';
        break;
        // 
    case "$adminBase/index":
        include 'admin';
        break;
        // Authentication
    case "/pdv-systeme/login":
        include 'login.php';
        break;
    case "/pdv-systeme/logout":
        include 'logout.php';
        break;
    case "/pdv-systeme":
        include '/';
        break;
        // Autres cas...
    default:
        // Gérer les pages non trouvées ou les URL invalides
        header("HTTP/1.0 404 Not Found");
        include '404.php';
}
