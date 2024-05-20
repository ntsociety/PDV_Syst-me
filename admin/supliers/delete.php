<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pdv-systeme/admin/inc/ctx-head.php';


$paraId = checkParametId('id');
if (is_numeric($paraId)) {
    $suplierId = $paraId;
    $suplier = getById("supliers", $suplierId);
    if ($suplier['status'] == 200) {
        $deleteSuplier = destroy('supliers', $suplierId);
        if ($deleteSuplier) {

            redirect("supliers", "Fournisseur supprimé avec succès !");
        } else {
            redirect("supliers", "Quelques choses s'est mal passés", false);
        }
    } else {

        redirect("supliers", "Quelques choses s'est mal passés", false);
    }
} else {
    redirect("supliers", "Quelques choses s'est mal passés id $paraId", false);
}
