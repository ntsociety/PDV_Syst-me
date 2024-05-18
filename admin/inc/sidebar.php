<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="<?= $adminBase ?>index">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link" href="<?= $adminBase ?>orders/create">
                    <div class="sb-nav-link-icon"><i class="fas fa-bell"></i></div>
                    Ajouter Commande
                </a>
                <a class="nav-link" href="<?= $adminBase ?>orders">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    Commandes
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategories" aria-expanded="false" aria-controls="collapseCategories">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Catégorie
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseCategories" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="<?= $adminBase ?>category/create">Ajouter Catégorie</a>
                        <a class="nav-link" href="<?= $adminBase ?>category">Voir Catégorie</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduit" aria-expanded="false" aria-controls="collapseProduit">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Produit
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseProduit" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="<?= $adminBase ?>produits/create">Ajouter Produit</a>
                        <a class="nav-link" href="<?= $adminBase ?>produits">Voir Produits</a>
                    </nav>
                </div>


                <!-- Manage User -->
                <div class="sb-sidenav-menu-heading">Manage User</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseClients" aria-expanded="false" aria-controls="collapseClients">
                    Client
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseClients" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="<?= $adminBase ?>clients/create">Ajouter Client</a>
                        <a class="nav-link" href="<?= $adminBase ?>clients">Voir Clients</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSupliers" aria-expanded="false" aria-controls="collapseSupliers">
                    Fournisseur
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseSupliers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="<?= $adminBase ?>supliers/create">Ajouter</a>
                        <a class="nav-link" href="<?= $adminBase ?>supliers">Voir</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAdmins" aria-expanded="false" aria-controls="collapseAdmins">
                    Admins/Staff
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseAdmins" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="<?= $adminBase ?>admin-create">Ajouter Admins</a>
                        <a class="nav-link" href="<?= $adminBase ?>admins">Voir Admins</a>
                    </nav>
                </div>

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>