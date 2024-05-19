<?php include 'inc/head.php' ?>

<div class="py-5" style="background: url('/pdv-systeme/admin/assets/female.jpg')no-repeat center/cover;">
    <div class="overlay" style="background-color:rgba(0, 0, 0, 0.6);">
        <div class="container my-5">
            <div class="row">
                <div class="col-md-12 py-5 text-center">
                    <?= alertMessage() ?>
                    <h1 class="mt-3 text-white">PDV Système</h1>
                    <?php
                    if (!isset($_SESSION['adminLogined'])) {
                    ?>
                        <a href="login.php" class="btn btn-primary mt-4">Se connecter</a>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'inc/footer.php' ?>