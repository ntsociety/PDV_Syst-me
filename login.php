<?php
include 'inc/head.php';

if (isset($_SESSION['adminLogined'])) {
    header("location: /pdv-systeme");
}
?>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow rounded-4 p-5">
                <?php alertMessage() ?>
                <h4 class="text-dark mb-3">Connextez-vous à PDV</h4>
                <form action="login-code.php" method="post">
                    <div class="mb-3">
                        <label for="">Email ou Numéro</label>
                        <input type="text" name="login" id="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Mot de passe</label>
                        <input type="password" name="password" id="" class="form-control">
                    </div>
                    <button class="btn btn-primary w-100" name="loginBtn" type="submit">Se Connecter</button>
                </form>
            </div>
        </div>
    </div>
</div>



<?php include 'inc/footer.php' ?>