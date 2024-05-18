<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pdv-systeme/admin/inc/ctx-head.php';


$paraId = checkParametId('id');
if (is_numeric($paraId)) {
    $categoryId = $paraId;
    $category = getById("categories", $categoryId);
    if ($category['status'] == 200) {
        $deleteCategory = destroy('categories', $categoryId);
        if ($deleteCategory) {

            redirect("category/category", "Catégorie supprimé avec succès !");
        } else {
            redirect("category/category", "Quelques choses s'est mal passés", false);
        }
    } else {

        redirect("category/category", "Quelques choses s'est mal passés", false);
    }
} else {
    redirect("category/category", "Quelques choses s'est mal passés id $paraId", false);
}
