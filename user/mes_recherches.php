<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Mes recherches</title>
</head>
<style>
.container {
    margin-top: 50px;
}

.pagination {
    justify-content: center;
    align-content: center;
}

ul {
    display: inline-block;
}
</style>

<body>
    <!----------------------------------------------------------------------------------------------------------->
    <div class="container ">
        <div class=" card text-white mb-3 shadow" style=" max-width: 100%; background-color:dodgerblue;">
            <div class=" card-body">
                <h5 class="card-title">Historique</h5>
                <p class="card-text">Vous pouvez consulter votre historique sur notre site WebScraping </p>
            </div>
        </div>



        <!---------------------------------------------------------------------------------------------->
        <div class=" card text-white mb-4 shadow mb-3 mt-3"
            style=" max-width: 100%; height:70px; background-color:#C0C0C0;">
            <div class="card-body  ">
                <form method="POST" action="mes_recherches.php">
                    <div class="row g-3  ">
                        <div class="input-group w-50">
                            <input type="search" class="form-control  " placeholder="cherchez par l'URL"
                                aria-label="Search" aria-describedby="search-addon" name="motCle" />

                            <button type="submit" class="btn btn-primary " name="btnEnvoyer">chercher</button>
                        </div>
                        <div class="col-sm">
                            <input type="hidden" name="ID" value="<?php if (isset($_GET["id"])) {
                                                                        echo $_GET["id"];
                                                                    } ?>">
                        </div>

                        <div class="col-sm">
                            <a href="../home.php" class="btn btn-primary " role="button"
                                style="position:relative; left: 177px;" aria-pressed="true">Annuler</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!----------------------------------------------------------------------------------------------->
        <?php
        if (isset($_GET["id"])) {
            $idu = $_GET["id"];
        } else {
            $idu = $_POST["ID"];
        }

        require("../connexion.php");
        $stm = $pdo->prepare("select * from recherches,user_recherche,user where 
        recherches.id_recherche=user_recherche.id_recherche and user_recherche.id_user=user.id  and user.id = ?");
        $stm->execute([$idu]);
        $search = $stm->fetchAll(PDO::FETCH_ASSOC);

        $mc = "";
        if (isset($_POST["btnEnvoyer"])) {
            $mc = $_POST["motCle"];
        }




        /**********************************************************************************************************/
        if (sizeof($search) > 0) {
            $stm = $pdo->prepare("select * from recherches,user_recherche,user where 
            recherches.id_recherche=user_recherche.id_recherche and user_recherche.id_user=user.id
            and user.id = ? and  recherches.URL like ? order by  recherches.id_recherche desc");
            $stm->execute([
                $idu,
                "%"  . $mc .  "%",
            ]);
            $users = $stm->fetchAll(PDO::FETCH_ASSOC);
            if (sizeof($users) > 0) {
                echo '<table  class="table table-bordered shadow">';
                echo  "<thead class='table-info' align='center'><tr>";
                echo '<th  scope="col">Id recherche</th><th align="center" scope="col">URL</th>
                <th align="center" scope="col">date</th><th  align="center" scope="col">Action</th></thead>';

                foreach ($users as $s) {
                    echo '<tr><td align="center" scope="row">' . $s["id_recherche"] . '</td>';
                    echo '<td align="center">' . $s["URL"] . '</td><td align="center">' .  $s["date"] .
                        '</td><td align="center"><a style="margin-right: 20px;" class="btn btn-primary"  href="supprimer_recherche.php?IDU=' .  $s["id_recherche"] . '" role="button">
                        supprimer</a><a class="btn btn-success "  href="excel.php?IDU=' . $s["id_recherche"] . '" role="button">exporter vers excel</a></td>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Alert!</h4>
            <p>URL ' . $mc . ' n existe pas</p>
            </div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Alert</h4>
                <p>Aucune recherche a montrer ! </p>
                </div>';
        }

        echo '</table >';



        ?>

    </div>


</body>

</html>