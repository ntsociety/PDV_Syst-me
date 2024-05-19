<nav class="navbar navbar-expand-lg bg-whit shadow">
    <div class="container">
        <a class="navbar-brand" href="#">PDV Systéme</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
                </li>
                <?php
                if (isset($_SESSION['adminLogined'])) {
                    $admin = $_SESSION['adminLogined'];
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href=""><?= $admin['name'] ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger" href="/pdv-systeme/logout">Se déconnecter</a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/pdv-systeme/login">Se connecter</a>
                    </li>
                <?php
                }

                ?>
            </ul>
        </div>
    </div>
</nav>