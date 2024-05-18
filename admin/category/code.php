<?php
include "../../config/function.php";




// update
if (isset($_POST['updateCategory'])) {
    $categoryId = validate($_POST['id']);
    $categoryData = getById("categories", $categoryId);
    if ($categoryData['status'] != 200) {
        redirect("category", "Veillez donner l'id", false);
    }
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $status = isset($_POST['status']) == true ? 1 : 0;


    if ($name != "") {

        $data = [
            // name	email	phone	password	is_ban
            'name' => $name,
            'description' => $description,
            'status' => $status,
        ];
        $result = update('categories', $categoryId, $data);
        if ($result) {

            redirect('category', "Catégorie modifié avec succès !");
        } else {
            redirect('category/edit?id=' . $categoryId, "Quelques choses s'est mal passés.", false);
        }
    } else {
        redirect('category/edit?id=' . $categoryId, "Veillez renseignez le nom. ", false);
    }
}

// category create
if (isset($_POST['saveCategory'])) {
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $status = isset($_POST['status']) == true ? 1 : 0;

    if ($name != "") {
        $data = [
            // name	email	phone	password	is_ban
            'name' => $name,
            'description' => $description,
            'status' => $status,
        ];
        $result = insert('categories', $data);
        if ($result) {

            redirect('category', "Catégorie ajouté avec succès !");
        } else {
            redirect('category/create', "Quelques choses s'est mal passés.", false);
        }
    } else {
        redirect('category/create', "Veillez renseignez le nom. ", false);
    }
}
