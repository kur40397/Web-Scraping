<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Dashboard</title>
</head>
<html>
<?php
require("../connexion.php");
?>

<style>
.container {
    margin-top: 50px;
}
</style>

<body>

    <div class="container">
        <!-----------------------------------titre du Dashboard------------------------------------------------------>
        <div class=" card text-white mb-4 shadow " style=" max-width: 100%; background-color:dodgerblue;">
            <div class=" card-body">
                <h5 class="card-title">Dashboard</h5>
                <p class="card-text">Votre représentation visuelle des utilisateurs dans le Web Scraping</p>
            </div>
        </div>
        <!------------------statistique sur le nombre d'utilisateur, d'administrateur, le nombre de recherches-------------------------------------------------->
        <div class="row d-flex justify-content-between">
            <div class="card text-white bg-primary me-5 mt-3  shadow"
                style="max-width: 16rem; height:120px;position:relative;left:16px">
                <div class=" card-body">
                    <h5 class="card-title">Nombre total d'utilisateurs:</h5>
                    <?php
                    $stm = $pdo->prepare("select * from user");
                    $stm->execute([]);
                    $users = $stm->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <h2 class="card-text"><?php echo sizeof($users); ?></h2>
                </div>
            </div>
            <div class="card text-white bg-secondary me-5 mt-3  shadow"
                style="max-width: 16rem;height:120px;position:relative;left:24px">

                <div class="card-body">
                    <h5 class="card-title">Nombre total d'administrateur:</h5>
                    <?php
                    $stm = $pdo->prepare("select * from admin");
                    $stm->execute([]);
                    $admin = $stm->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <h2 class="card-text"><?php echo sizeof($admin); ?></h2>
                </div>
            </div>
            <div class="card text-white bg-success me-5 mt-3  shadow"
                style="max-width: 16rem;height:120px;position:relative;left:35px">
                <div class="card-body  ">
                    <h5 class="card-title">Nombre total de recherche:</h5>
                    <?php
                    $stm = $pdo->prepare("select * from recherches");
                    $stm->execute([]);
                    $search = $stm->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <h2 class="card-text"><?php echo sizeof($search); ?></h2>
                </div>
            </div>
            <!--------------------------un formulaire qui permet de chercher , filter , actualiser la table et aussi annuler--------------------------------->
        </div>
        <div class=" card text-white mb-4 shadow mb-3 mt-3"
            style=" max-width: 100%; height:70px; background-color:#C0C0C0;">
            <div class="card-body">
                <form method="POST" action="afficher_users.php">
                    <div class="row g-3">
                        <div class="input-group w-25">
                            <input type="search" class="form-control " placeholder="cherchez par nom"
                                aria-label="Search" aria-describedby="search-addon" name="motCle" />
                            <button type="submit" class="btn btn-primary " name="btnEnvoyer">chercher</button>
                        </div>
                        <div class="col-sm">
                            <button type="submit" class="btn btn-success " name="reset"
                                style="position:relative; left: 620px;">Remettre</button>
                        </div>
                        <div class="col-sm">
                            <select onchange="this.form.submit()" class="form-select w-50" aria-label=" select example"
                                name="sel">
                                <option value="<?php if (isset($_POST["sel"])) {
                                                    echo  $_POST["sel"];
                                                } ?>">limit
                                </option>
                                <option value="2">2</option>
                                <option value="4">4</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                        <div class="col-sm">
                            <a href="../home.php" class="btn btn-primary " role="button"
                                style="position:relative; left: 177px;" aria-pressed="true">Annuler</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!---------------------------------------------------------------------------------------------------->
        <?php
        // cette partie permet de vérifier s'il  existe  des utilisateur pour les afficher 
        $stm = $pdo->prepare("select * from user ");
        $stm->execute([]);
        $users = $stm->fetchAll(PDO::FETCH_ASSOC);
        // pour limiter l'affichage de notre table
        if (isset($_POST["sel"])) {
            $l = $_POST["sel"];
        } else {
            $l = sizeof($users);
        }
        // la partie ou l'utilisateur fait actualiser la table
        if (isset($_POST["reset"])) {
            $mc = "";
        }
        // la partie recherche 
        $mc = "";
        if (isset($_POST["btnEnvoyer"])) {
            $mc = $_POST["motCle"];
        }
        if (sizeof($users) > 0) {
            $stm = $pdo->prepare("select * from  user where nom like ? order by id desc");
            $stm->execute(["%" . $mc . "%"]);
            $users = $stm->fetchAll(PDO::FETCH_ASSOC);/* récuperer un ensemble de ligne d'un  résultat */
            if (sizeof($users) > 0) {
                echo '<table  class="table table-bordered bg-light shadow ">';
                echo  "<thead class='table-info' align='center'><tr>";
                echo '<th  scope="col">Id</th><th align="center" scope="col">Image</th>
            <th align="center" scope="col">Nom</th><th align="center" scope="col">Prenom</th>
            <th align="center" scope="col">Email</th><th  align="center" scope="col">Supprimer</th>
            <th align="center" scope="col">statut</th></thead>';
                $i = 0;
                foreach ($users as $s) {
                    if ($i == $l) {
                        break;
                    }
                    echo '<tr><td align="center" scope="row">' . $s["id"] . '</td><td align="center">';
                    if (isset($s["image"])) {
                        echo '<img  class="rounded-circle" src=../user/' . $s["image"] . ' width=70px height=70px />';
                    } else {
                        echo '<img class="rounded-circle"  src="../user/image/avatar.png" width=70px height=70px >';
                    }
                    echo '</td><td align="center">' . $s["nom"] . '</td><td align="center">' .
                        $s["prenom"] . '</td><td align="center">' . $s["email"] .
                        '</td><td align="center"><a class="btn btn-primary"  
                    href="supprimer_recherche.php?id=' . $s["id"] . '" role="button">
                    supprimer</a>
                    </td><td align="center">';
                    // pour permet de connaitre le status de l'utilisateur
                    if (isset($_SESSION['email']) && strcmp($_SESSION['email'], $s["email"]) == 0) {
                        echo "<a class='btn btn-success' role='button'>en ligne</a>";
                    } else {
                        echo "<a class='btn btn-danger' role='button'>hors ligne</a>";
                    }
                    echo "</td></tr>";
                    $i++;
                }
                echo '</table>';
            } else {

                echo '<div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Alert!</h4>
        <p>l\'utilisateur ' . $mc . ' n existe pas !</p>
        </div>';
            }
        } else {
            // si la table est vide on affiche un alert
            echo '<div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Alert!</h4>
            <p>Aucun utilisateur a montrer !</p></div>';
        }
        ?>
        <!---------------------------------------------------------------------------------------------------->
    </div>

</html>

</body>