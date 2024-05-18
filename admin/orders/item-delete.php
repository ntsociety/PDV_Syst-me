<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pdv-systeme/admin/inc/ctx-head.php';


$paraResult = checkParametId('index');
if (is_numeric($paraResult)) {
    $indexValue = $paraResult;
    if (isset($_SESSION['produitItemIds']) && isset($_SESSION['produitItems'])) {
        unset($_SESSION['produitItemIds'][$indexValue]);
        unset($_SESSION['produitItems'][$indexValue]);
        redirect("orders/create", "Element suprimé");
    } else {
        redirect("orders/create", "pas d'Element", false);
    }
} else {
    redirect("orders/create", "Quelques choses s'est mal passés id $paraResult", false);
}
