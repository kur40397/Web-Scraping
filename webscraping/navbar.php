<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chercher</title>
    <!-- bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- css file -->
    <link rel="stylesheet" href="../style.css">
    <!-- js file -->
    <script type="text/javascript" src="script1.js"></script>
</head>

<body>
    <header>
        <!-------------------------------------------------logo de Web scraping-------------------------------------->
        <a href="../home.php" class="logo">WebScraping </a>
        <!---------------------------------------------bare de recherche--------------------------------------------------------->
        <form method="POST" class="input-group w-75">
            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                aria-describedby="search-addon" name="url" />
            <button type=" submit" class="btn btn-primary" name="search">chercher</button>
        </form>
    </header>
    <?php
    require("simple_html_dom.php"); // pour analyse pour page html , pour extration du contenu html
    if (isset($_GET["ID"])) { // si l'id de l'utilisateur existe 
        if (isset($_POST["search"])) { // si cliquer sur le boutton chercher
            if (!empty($_POST["url"])) { // si l'utilisateur a saissie dans l'url
                if (filter_var($_POST["url"], FILTER_VALIDATE_URL)) { // on filtre url pour le valider
                    $url = true; // vérifier si l'url est valide
                    require("../connexion.php"); // connexion
                    $stm = $pdo->prepare("insert into recherches  (URL,date) values(?,?)"); // on insert l'url et la date de la recherche dans la table recherches
                    $stm->execute([
                        $_POST['url'],
                        date('d-m-y h:i:s')
                    ]);
                    /**********************************************************************************/
                    $rech = $pdo->lastInsertId();
                    $stm = $pdo->prepare("insert into user_recherche (id_user,id_recherche) values (?,?)");
                    $stm->execute([$_GET["ID"], $rech]);
                    /**********************************************************************************/
                } else {
                    //si l'utilisateur a saisie un mauvais URL
                    $url = false;
                    echo "<div class='container alert alert-danger position-relative' style='top:80px; left:50px; width:60%' role='alert'>";
                    echo "<h4 class='alert-heading'>Oops !</h4>";
                    echo "<p>l'URL que vous avez posez n'est pas valide</p>";
                    exit(); // on quitte
                }
            }
        }
    }

    ?>


    <?php
    if (isset($url) && $url == true) {
        $html = file_get_html($_POST["url"]); // permet d'extraire le contenu html => avoir tout le contenu html


    ?>

    <div class="container position-relative mb-5" style="top:80px; left: 65px;">

        <!----------------------------contenaire de chaque produit------------------------------>
        <div class="row  row-cols-md-3 g-3 w-75  ms-5 card-list" id="card-list">
            <?php
                for ($i = 1; $i < 13; $i++) { // on afficher 12 produit
                    // implode() rendre un tableau un chaine de caractère
                ?>
            <div class="col" name="card">
                <div class="card h-100">
                    <?php preg_match_all('|<img.*?src=[\'"](.*?)[\'"].*?>|i', $html, $matches); ?>
                    <img src=<?php echo $matches[1][$i] ?> class="card-img-top">
                    <div class="card-body">
                        <!-- va retourner un tableay des noms -->
                        <!--implode() rendre un tableau un chaine de caractère-->
                        <!-- trouve moi tous les div avec la classe info et au sein de ce div touve le titre h3 avec la classe name
                        <?php $name = $html->find('div[class="info"]', $i)->find('h3[class="name"]'); ?>
                        <!-- parcourir -->
                        <h5 class="card-text "> <?php echo implode($name) ?></h5>
                        <?php $prix = $html->find('div[class="info"]', $i)->find('div[class="prc"]'); ?>
                        <h5 class="card-text " style="margin-bottom:-30px;"><?php echo implode($prix) ?></h5>
                        <?php $prixold = $html->find('div[class="info"]', $i)->find('div[class="old"]'); ?>
                        <p class="card-text mt-5"><small><strike><?php echo implode($prixold) ?></strike></small></p>
                    </div>
                </div>
            </div>
            <?php
                    // strip_tags() supprimer le contenu html
                    // inserer les produits dans la table prod_excel
                    $stm = $pdo->prepare("INSERT INTO prod_excel  (desc_prod,nov_prix,anc_prix,id_recherche) values(?,?,?,?)");
                    $stm->execute([
                        strip_tags(implode($name)),
                        strip_tags(implode($prix)),
                        strip_tags(implode($prixold)),
                        $rech
                    ]);
                }
            }

            ?>

        </div>
    </div>

    <!-------------------------------------------footer---------------------------------------------------------->

    <footer class="footer" style="position:absolute; bottom:-2000px; left:0px">

        <p class="footer-title">Copyright@<span>WebScraping</span></p>
        <div class="social-icons">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-linkedin"></i></a>
            <a href="#"><i class="bi bi-twitter"></i></a>
        </div>
    </footer>


</body>


</html>