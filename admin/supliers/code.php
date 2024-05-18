<?php
include "../../config/function.php";







// update admin
if (isset($_POST['update'])) {
    $suplierId = validate($_POST['id']);
    $suplierData = getById("supliers", $suplierId);
    if ($suplierData['status'] != 200) {
        redirect("supliers", "Veillez donner l'id", false);
    }
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $adresse = validate($_POST['adresse']);
    $status = isset($_POST['status']) == true ? 1 : 0;

    if ($name != "" && $phone != "") {
        if ($email != "") {
            $emailCheck = mysqli_query($db_connect, "SELECT * from supliers where email = '$email' and id != '$suplierId'");
            if ($emailCheck) {
                if (mysqli_num_rows($emailCheck) > 0) {
                    redirect('supliers/edit?id=' . $suplierId, "Cet email existe déjà par une autre", false);
                }
            }
        }

        $phoneCheck = mysqli_query($db_connect, "SELECT * from supliers where phone = '$phone' and id != '$suplierId'");
        if ($phoneCheck) {
            if (mysqli_num_rows($phoneCheck) > 0) {
                redirect('supliers/edit?id=' . $suplierId, "Cet numéro existe déjà par une autre", false);
            }
        }

        $data = [
            // name	email	phone	password	is_ban
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'adresse' => $adresse,
            'status' => $status,
        ];
        $result = update('supliers', $suplierId, $data);
        if ($result) {

            redirect('supliers/edit?id=' . $suplierId, "Fournisseur modifié avec succès !");
        } else {
            redirect('supliers/edit?id=' . $suplierId, "Quelques choses s'est mal passés.", false);
        }
    } else {
        redirect('supliers/edit?id=' . $suplierId, "Veillez renseignez les champs nécessaires. ", false);
    }
}
// create admin
if (isset($_POST['save'])) {
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $adresse = validate($_POST['adresse']);
    $status = isset($_POST['status']) == true ? 1 : 0;

    if ($name != "" && $phone != "") {
        if ($email != "") {
            $emailCheck = mysqli_query($db_connect, "SELECT * from supliers where email = '$email'");
            if ($emailCheck) {
                if (mysqli_num_rows($emailCheck) > 0) {
                    redirect('supliers/create', "Cet email existe déjà par une autre", false);
                }
            }
        }
        $phoneCheck = mysqli_query($db_connect, "SELECT * from supliers where phone = '$phone'");
        if ($phoneCheck) {
            if (mysqli_num_rows($phoneCheck) > 0) {
                redirect('supliers/create', "Cet numéro existe déjà par une autre", false);
            }
        }

        $data = [
            // name	email	phone	password	is_ban
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'adresse' => $adresse,
            'status' => $status,
        ];
        $result = insert('supliers', $data);
        if ($result) {

            redirect('supliers/supliers', "Fournisseur ajouté avec succès !");
        } else {
            redirect('supliers/create', "Quelques choses s'est mal passés.", false);
        }
    } else {
        redirect('supliers/create', "Veillez renseignez les champs nécessaires. ", false);
    }
}
