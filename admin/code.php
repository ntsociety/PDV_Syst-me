<?php
include "../config/function.php";







// update admin
if (isset($_POST['updateAdmin'])) {
    $adminId = validate($_POST['id']);
    $adminData = getById("admins", $adminId);
    if ($adminData['status'] != 200) {
        redirect("admins", "Veillez donner l'id", false);
    }
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $password = validate($_POST['password']);
    $is_ban = isset($_POST['is_ban']) == true ? 1 : 0;
    if ($password != "") {
        $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);
    } else {
        $password = $adminData['data']['password'];
    }

    if ($name != "" && $email != "" && $phone != "") {
        $emailCheck = mysqli_query($db_connect, "SELECT * from admins where email = '$email' and id != '$adminId'");
        if ($emailCheck) {
            if (mysqli_num_rows($emailCheck) > 0) {
                redirect('admins-edit?id=' . $adminId, "Cet email est déjà utilisé par une autre", false);
            }
        }
        $phoneCheck = mysqli_query($db_connect, "SELECT * from admins where phone = '$phone' and id != '$adminId'");
        if ($phoneCheck) {
            if (mysqli_num_rows($phoneCheck) > 0) {
                redirect('admins-edit?id=' . $adminId, "Cet numéro est déjà utilisé par une autre", false);
            }
        }

        $data = [
            // name	email	phone	password	is_ban
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => $bcrypt_password,
            'is_ban' => $is_ban
        ];
        $result = update('admins', $adminId, $data);
        if ($result) {

            redirect('admin-edit?id=' . $adminId, "Admin modifié avec succès !");
        } else {
            redirect('admin-edit?id=' . $adminId, "Quelques choses s'est mal passés.", false);
        }
    } else {
        redirect('admin-edit?id=' . $adminId, "Veillez renseignez les champs nécessaires. ", false);
    }
}
// create admin
if (isset($_POST['saveAdmins'])) {
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $password = validate($_POST['password']);
    $is_ban = isset($_POST['is_ban']) == true ? 1 : 0;

    if ($name != "" && $email != "" && $phone != "" && $password != "") {
        $emailCheck = mysqli_query($db_connect, "SELECT * from admins where email = '$email'");
        if ($emailCheck) {
            if (mysqli_num_rows($emailCheck) > 0) {
                redirect('admin-create', "Cet email est déjà utilisé par une autre", false);
            }
        }
        $phoneCheck = mysqli_query($db_connect, "SELECT * from admins where phone = '$phone'");
        if ($phoneCheck) {
            if (mysqli_num_rows($phoneCheck) > 0) {
                redirect('admin-create', "Cet numéro est déjà utilisé par une autre", false);
            }
        }
        $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            // name	email	phone	password	is_ban
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => $bcrypt_password,
            'is_ban' => $is_ban
        ];
        $result = insert('admins', $data);
        if ($result) {

            redirect('admins', "Admin ajouté avec succès !");
        } else {
            redirect('admin-create', "Quelques choses s'est mal passés.", false);
        }
    } else {
        redirect('admin-create', "Veillez renseignez les champs nécessaires. ", false);
    }
}
