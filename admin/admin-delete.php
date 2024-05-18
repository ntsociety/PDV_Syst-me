<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pdv-systeme/admin/inc/ctx-head.php';


$paraId = checkParametId('id');
if (is_numeric($paraId)) {
    $adminId = $paraId;
    $admin = getById("admins", $adminId);
    if ($admin['status'] == 200) {
        $deleteAdmin = destroy('admins', $adminId);
        if ($deleteAdmin) {

            redirect("admins", "Admin supprimé avec succès !");
        } else {
            redirect("admins", "Quelques choses s'est mal passés", false);
        }
    } else {

        redirect("admins", "Quelques choses s'est mal passés", false);
    }
} else {
    redirect("admins", "Quelques choses s'est mal passés id $paraId", false);
}
