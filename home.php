<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js">
    </script>
    <!-- popper -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js">
    </script>
    <!-- bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js">
    </script>
    <!-- css file-->
    <link rel="stylesheet" href="style.css">

    <title>Page d'acceuil</title>
</head>

<body>
    <?php
    session_start();
    ?>
    <div class="center">
        <!--menu-->
        <header>
            <a href="#" class="logo">WebScraping </a>
            <!--navigation-->
            <nav class="navigation">

                <a class="active" href=" #Services">Services</a>
                <a href="#Domaines">Domaines</a>
                <a href="#Contact">Contact</a>
                <?php
                if (isset($_SESSION['prenom'])) {
                    $idu = $_SESSION["idu"];
                ?>
                <a data-toggle="dropdown" aria-expanded="false" href="#">Compte</a>
                <div class="dropdown-menu">
                    <?php echo "<a class='dropdown-item' href='user/voir_profil.php?id=$idu'>Mon profil</a>";
                        echo "<a class='dropdown-item' href='user/editer_profils.php?id=$idu'>Editer mon profil</a>";
                        echo "<a class='dropdown-item' href='user/mes_recherches.php?id=$idu'>Mes recherche</a>";
                        ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="user/logout.php">Déconnexion</a>
                </div>
                <?php
                } else if (isset($_SESSION['PRENOM'])) {
                    $idu = $_SESSION["IDA"];
                ?>
                <a data-toggle="dropdown" aria-expanded="false" href="#">Compte</a>
                <div class="dropdown-menu">
                    <?php echo "<a class='dropdown-item' href='admin/voir_profil_admin.php?id=$idu'>Mon profil</a>";
                        echo "<a class='dropdown-item' href='admin/modifier_profil_admin.php?id=$idu'>Editer mon profil</a>";
                        echo "<a class='dropdown-item' href='admin/afficher_users.php?id=$idu'>Dashboard</a>";
                        ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="user/logout.php">Déconnexion</a>
                </div>
                <?php
                } else {
                ?>
                <a href="user/register.php">Inscription</a>
                <a href="user/login.php">Connexion</a>
                <?php
                }
                ?>
            </nav>
        </header>
        <!-------------------------------------partie 1: présentation de notre site-------------------------------------->
        <section class="main">
            <div>
                <span>WebScraping</span>
                <p>WebScraping est une application web de grattage des données gratuit et puissant.
                    Avec notre grattoir Web avancé, l'extraction de données est aussi simple
                    en inserant l'URL et en cliquant sur chercher</p>
                <a href="#projects" class="main-btn"></a>
                <?php
                if (isset($_SESSION['prenom'])) {
                    echo "<a href='webscraping/navbar.php?ID=$idu' class='btn btn-primary btn-lg' name='btn' >Commencez maintenant</a>";
                }
                ?>



            </div>
        </section>
        <!--------------------------partie 2:les étapes pour extraires des données du web scraping------------------------------------->
        <section id="Services" class="steps">
            <h2 class="title">Extraire des données Web en 3 étapes</h2>
            <div class="content">
                <div class="cards">
                    <div class="icon">
                        <i class="bi bi-filetype-html"></i>
                    </div>
                    <div class="info">
                        <h3>Etape 1</h3>
                        <p>Entrez l'URL du site Web dont vous souhaitez extraire les données
                        </p>
                    </div>
                </div>
                <div class="cards">
                    <div class="icon">
                        <i class="bi bi-search"></i>
                    </div>
                    <div class="info">
                        <h3>Etape 2</h3>
                        <p>cliquez sur rechercher pour commencer le processus d'extraction
                        </p>
                    </div>
                </div>
                <div class="cards">
                    <div class="icon">
                        <i class="bi bi-filetype-csv"></i>
                    </div>
                    <div class="info">
                        <h3>Etape 3</h3>
                        <p>Une fois les données extraites, il les convertit au format Excel
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-------------------------------parite 3:les domaines de d'extraction---------------------------------------->

        <section style="position:relative;bottom:-10px;background-color:azure;" id="Domaines">
            <h2 class="title">Quel type de données pouvons-nous scraper ?</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card h-100">
                        <img src="image/buy.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title" style="color:dodgerblue;">Produit et prix</h5>
                            <p class="card-text">Grattez les sites Web de commerce électronique pour extraire les prix
                                des produits, la disponibilité,
                                Commentaires,
                                importance,
                                réputation de la marque et plus encore. Surveillez votre chaîne de distribution et
                                analysez les avis des clients
                                à
                                améliorez vos produits et vos profits avec ces données.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="image/stock.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title" style="color:dodgerblue;">Le marché financier</h5>
                            <p class="card-text">Recueillir des données sur les marchés financiers mondiaux, les marchés
                                boursiers, le trading,
                                matières premières et indicateurs économiques. Améliorer et augmenter les données
                                disponibles pour les analystes
                                et
                                modèles financiers internes pour les rendre plus performants.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="image/estate.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title" style="color:dodgerblue;">Immobilier</h5>
                            <p class="card-text">Grattez les annonces immobilières, les agents, les courtiers, les
                                maisons, les appartements,
                                Hypothèques, saisies, MLS. Gardez un œil sur les nouvelles données en configurant un
                                e-mail personnalisé
                                alertes.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="image/job.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title" style="color:dodgerblue;">Données de travail</h5>
                            <p class="card-text">Trouvez les meilleurs candidats pour votre entreprise ou gardez un œil
                                sur qui vous
                                la concurrence recrute. Agrégez les offres d'emploi des sites d'emploi ou des sites Web
                                d'entreprise - tout cela peut
                                être
                                accompli grâce au web scraping.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="image/travel.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title" style="color:dodgerblue;">Voyager</h5>
                            <p class="card-text">Extraire les données des sites de voyage pour analyser avec précision
                                les avis des hôtels,
                                prix, disponibilité des chambres et prix des billets d'avion en utilisant notre web
                                scraping avancé
                                prestations de service. Restez compétitif grâce à l'utilisation des données.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="image/journal.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title" style="color:dodgerblue;">Journal</h5>
                            <p class="card-text">Alimentez votre prochain projet de recherche ou reportage avec des
                                données provenant du Web -
                                Données environnementales, données sur le développement du tiers monde, données sur la
                                criminalité, tendances locales et mondiales
                                etc.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--------------------------------partie 4:la partie contacte--------------------------------->

        <section id="Contact" class="contact">
            <h2 class="title">Contactez-nous</h2>
            <div class="content">
                <div class="cards">
                    <div class="icon">
                        <i class="bi bi-telephone"></i>
                    </div>
                    <div class="info">
                        <h3>Telephone</h3>
                        <a href="tel:05 22 11 22 33">05 22 11 22 33
                        </a>
                    </div>
                </div>
                <div class="cards">
                    <div class="icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <div class="info">
                        <h3>Email</h3>
                        <a href="mailto: WebScrap@gmail.com"> WebScrap@gmail.com</a>
                    </div>
                </div>
            </div>
        </section>
        <!--------------------------------partie 4:la partie contacte------------------------------------->


        <footer class="footer">


            <p class="footer-title">Copyright@<span>WebScraping</span></p>
            <div class="social-icons">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
                <a href="#"><i class="bi bi-twitter"></i></a>
            </div>
        </footer>
        <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
        <!-------------------------------------pop ups------------------------------------------------->


        <!-- Modal -->
        <?php if (!isset($_SESSION['prenom']) || !isset($_SESSION['PRENOM'])) { ?>
        <div class="modal fade" id="simpleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">WebScraping</h5>
                        <div class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x"></i>
                        </div>
                    </div>
                    <div class="modal-body">
                        Vous voulez recevoir des notifications ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="down()" id="hide-modal"
                            data-dismiss="modal"><i class="bi bi-bell-fill"></i> Abonné</button>

                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <!------------------------------------------------------------------------------------------->
</body>
<!-------------------------------------------fichier js-------------------------------------------------->
<script type="text/javascript" src="script1.js"></script>

</html>