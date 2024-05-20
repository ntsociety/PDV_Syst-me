<?php
include "../../config/function.php";





// ajax

if (isset($_POST['saveClient'])) {
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    if ($name != "" && $phone != "") {
        $phoneCheck = mysqli_query($db_connect, "SELECT * from customers where phone = '$phone'");
        if ($phoneCheck) {
            if (mysqli_num_rows($phoneCheck) > 0) {
                return jsonResponse(203, 'warning', "Ce numéro existe déjà par une autre");
            }
        }
        if ($email != "") {
            $emailCheck = mysqli_query($db_connect, "SELECT * from customers where email = '$email' limit 1");
            if ($emailCheck) {
                if (mysqli_num_rows($emailCheck) > 0) {
                    return jsonResponse(203, 'warning', "Cet email existe déjà par une autre");
                }
            }
        }



        $data = [
            // name	email	phone	password	is_ban
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
        ];
        $result = insert('customers', $data);
        if ($result) {
            return jsonResponse(200, 'success', 'Client ajouté avec succès! continuer');
        } else {
            return jsonResponse(500, 'warning', "Quelques choses s'est mal passé");
        }
    } else {
        return jsonResponse(422, 'warning', "Veillez renseignez les champs nécessaires");
    }
}

// update client
if (isset($_POST['updateClient'])) {
    $clientId = validate($_POST['id']);
    $clientData = getById("customers", $clientId);
    if ($clientData['status'] != 200) {
        redirect("clients", "Veillez donner l'id", false);
    }
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $adresse = validate($_POST['adresse']);
    $status = isset($_POST['status']) == true ? 1 : 0;

    if ($name != "" && $phone != "") {

        $phoneCheck = mysqli_query($db_connect, "SELECT * from customers where phone = '$phone' and id != '$clientId'");
        if ($phoneCheck) {
            if (mysqli_num_rows($phoneCheck) > 0) {
                redirect('clients/edit?id=' . $suplierId, "Cet numéro existe déjà par une autre", false);
            }
        }
        if ($email != "") {
            $emailCheck = mysqli_query($db_connect, "SELECT * from customers where email = '$email' and id != '$clientId'");
            if ($emailCheck) {
                if (mysqli_num_rows($emailCheck) > 0) {
                    redirect('clients/edit?id=' . $suplierId, "Cet email existe déjà par une autre", false);
                }
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
        $result = update('customers', $clientId, $data);
        if ($result) {

            redirect('clients/edit?id=' . $clientId, "Client modifié avec succès !");
        } else {
            redirect('clients/edit?id=' . $clientId, "Quelques choses s'est mal passés.", false);
        }
    } else {
        redirect('clients/edit?id=' . $clientId, "Veillez renseignez les champs nécessaires. ", false);
    }
}
// create client
if (isset($_POST['addClient'])) {
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $adresse = validate($_POST['adresse']);
    $status = isset($_POST['status']) == true ? 1 : 0;
    // var_dump($email != "");
    // return;
    // dd($email);

    if ($name != "" && $phone != "") {
        $phoneCheck = mysqli_query($db_connect, "SELECT * from customers where phone = '$phone'");
        if ($phoneCheck) {
            if (mysqli_num_rows($phoneCheck) > 0) {
                redirect('clients/create', "Cet numéro existe déjà par une autre", false);
            }
        }
        if ($email != "") {
            $emailCheck = mysqli_query($db_connect, "SELECT * from customers where email = '$email' limit 1");
            if ($emailCheck) {
                if (mysqli_num_rows($emailCheck) > 0) {
                    redirect('clients/create', "Cet email existe déjà par une autre", false);
                }
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
        $result = insert('customers', $data);
        if ($result) {

            redirect('clients', "Client ajouté avec succès !");
        } else {
            redirect('clients/create', "Quelques choses s'est mal passés.", false);
        }
    } else {
        redirect('clients/create', "Veillez renseignez les champs nécessaires. ", false);
    }
}
