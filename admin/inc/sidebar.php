<?php
$page = substr($_SERVER['REQUEST_URI'], 19);


?>

<style>
    #layoutSidenav_nav .sb-sidenav-dark {
        background-color: #175498 !important;
    }

    .sb-sidenav-dark .sb-sidenav-footer {
        background-color: #175494 !important;
    }
</style>

<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link <?= $page == "" ? 'active' : '' ?>" href="<?= $adminBase ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard

                </a>
                <a class="nav-link <?= $page == "orders/create" ? 'active' : '' ?>" href="<?= $adminBase ?>orders/create">
                    <div class="sb-nav-link-icon"><i class="fas fa-bell"></i></div>
                    Ajouter Commande
                </a>
                <a class="nav-link <?= $page == "orders/" ? 'active' : '' ?>" href="<?= $adminBase ?>orders">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    Commandes
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link
                <?= ($page == "category/create") || ($page == "category/")  ? 'collapse active' : 'collapsed' ?>
                
                " href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategories" aria-expanded="false" aria-controls="collapseCategories">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Catégorie
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse 
                <?= ($page == "category/create") || ($page == "category/")  ? 'show' : '' ?> " id="collapseCategories" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $page == "category/create" ? 'active' : '' ?>" href="<?= $adminBase ?>category/create">Ajouter Catégorie</a>
                        <a class="nav-link <?= $page == "category/" ? 'active' : '' ?>" href="<?= $adminBase ?>category">Voir Catégorie</a>
                    </nav>
                </div>
                <a class="nav-link 
                <?= ($page == "produits/create") || ($page == "produits/") ? 'collapse active' : 'collapsed' ?>
               
                " href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduit" aria-expanded="false" aria-controls="collapseProduit">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Produit
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse  
                <?= ($page == "produits/create") || ($page == "produits/") ? 'show' : '' ?>
               
                " id="collapseProduit" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $page == "produits/create" ? 'active' : '' ?>" href="<?= $adminBase ?>produits/create">Ajouter Produit</a>
                        <a class="nav-link <?= $page == "produits/" ? 'active' : '' ?>" href="<?= $adminBase ?>produits">Voir Produits</a>
                    </nav>
                </div>


                <!-- Manage User -->
                <div class="sb-sidenav-menu-heading">Gérer l'utilisateur</div>
                <a class="nav-link 
                <?= ($page == "clients/create") || ($page == "clients/") ? 'collapse active' : 'collapsed' ?>
               
                " href="#" data-bs-toggle="collapse" data-bs-target="#collapseClients" aria-expanded="false" aria-controls="collapseClients">
                    Client
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse
                <?= ($page == "clients/create") || ($page == "clients/") ? 'show' : '' ?>
               
                " id="collapseClients" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $page == "clients/create" ? 'active' : '' ?>" href="<?= $adminBase ?>clients/create">Ajouter Client</a>
                        <a class="nav-link <?= $page == "clients/" ? 'active' : '' ?>" href="<?= $adminBase ?>clients">Voir Clients</a>
                    </nav>
                </div>
                <a class="nav-link 
                <?= ($page == "supliers/create") || ($page == "supliers/") ? 'collapse active' : 'collapsed' ?>
               
                " href="#" data-bs-toggle="collapse" data-bs-target="#collapseSupliers" aria-expanded="false" aria-controls="collapseSupliers">
                    Fournisseur
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse
                <?= ($page == "supliers/create") || ($page == "supliers/") ? 'show' : '' ?>
                
                " id="collapseSupliers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $page == "supliers/create" ? 'active' : '' ?>" href="<?= $adminBase ?>supliers/create">Ajouter</a>
                        <a class="nav-link <?= $page == "supliers/" ? 'active' : '' ?>" href="<?= $adminBase ?>supliers">Voir</a>
                    </nav>
                </div>
                <a class="nav-link 
                <?= ($page == "admin-create") || ($page == "admins") ? 'collapse active' : 'collapsed' ?>
               
                " href="#" data-bs-toggle="collapse" data-bs-target="#collapseAdmins" aria-expanded="false" aria-controls="collapseAdmins">
                    Admins/Staff
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse
                <?= ($page == "admin-create") || ($page == "admins") ? 'show' : '' ?>
               
                " id="collapseAdmins" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $page == "admin-create" ? 'active' : '' ?>" href="<?= $adminBase ?>admin-create">Ajouter Admins</a>
                        <a class="nav-link <?= $page == "admins" ? 'active' : '' ?>" href="<?= $adminBase ?>admins">Voir Admins</a>
                    </nav>
                </div>

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Connecté en tant que:</div>
            <?= $_SESSION['adminLogined']['name'] ?>
        </div>
    </nav>
</div>