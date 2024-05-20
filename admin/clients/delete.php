<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pdv-systeme/admin/inc/ctx-head.php';


$paraId = checkParametId('id');
if (is_numeric($paraId)) {
    $clientId = $paraId;
    $client = getById("customers", $clientId);
    if ($client['status'] == 200) {
        $deleteClient = destroy('customers', $clientId);
        if ($deleteClient) {

            redirect("clients", "Clients supprimé avec succès !");
        } else {
            redirect("clients", "Quelques choses s'est mal passés", false);
        }
    } else {

        redirect("clients", "Quelques choses s'est mal passés", false);
    }
} else {
    redirect("clients", "Quelques choses s'est mal passés id $paraId", false);
}
