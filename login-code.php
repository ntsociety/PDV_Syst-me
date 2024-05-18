<?php
// include 'config/dbconnect.php';
include $_SERVER['DOCUMENT_ROOT'] . "/pdv-systeme/config/function.php";

// input field validation


if (isset($_POST['loginBtn'])) {
    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        $login = validate($_POST['login']);
        $password = validate($_POST['password']);
        try {
            $query = "SELECT * from admins where email = '$login' OR phone = '$login' limit 1";
            $response = mysqli_query($db_connect, $query);
            if (mysqli_num_rows($response) > 0) {
                $admin = mysqli_fetch_assoc($response);
                if (password_verify($password, $admin['password'])) {
                    if ($admin['is_ban'] != 1) {
                        $_SESSION['adminLogined'] = $admin;
                        redirect("", "Vous êtes connecté" . $e);
                    } else {
                        redirect("login", "Compte bani" . $e, false, false);
                    }
                } else {
                    redirect("login", "Mot de passe incorrect" . $e, false, false);
                }
            } else {
                redirect("login", "Aucune information trouvé" . $e, false, false);
            }
        } catch (Exception $e) {
            redirect("login", "Quelques choses s'est mal passés" . $e, false, false);
        }
    } else {
        redirect("login", "Remplir les champs", false, false);
    }
}
