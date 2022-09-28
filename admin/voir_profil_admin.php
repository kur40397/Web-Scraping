<?php

if (isset($_GET["id"])) {
    $idu = $_GET["id"];
    require("../connexion.php");
    $stm = $pdo->prepare("select * from admin where id=?");
    $stm->execute([$idu]);
    $tab = $stm->fetch(PDO::FETCH_ASSOC);
}
?>
<!doctype html>

<body lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Voir Profil</title>
        <!-- bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- boostrap icons-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <!-- css pour l'avatar de l'utilisateur -->
        <style>
        .avatar {
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 10px;
            width: 150px;
            height: 150px;
            border-radius: 50%;
        }
        </style>
    </head>
</body>
<div class="container">
    <div class="col-md-4 offset-md-4">
        <div class="well well-sm">
            <form method="post" action="login.php" class="mt-5 border p-4 bg-light shadow"
                enctype="multipart/form-data">
                <h3>Votre profil</h3>
                <?php
                if (isset($tab['image'])) {
                    echo "<img src=" . $tab['image'] . " class=avatar alt='Avatar'>";
                } else {
                    echo "<img src='image/avatar.png' class=avatar alt='Avatar'>";
                }
                ?>
                <h2 style="text-align:center"><?php echo $tab["nom"] . " " . $tab["prenom"] ?></h2>
                <?php

                echo "<p style='margin-left: 8px; margin-top:20px'><i style='margin-right: 30px;'
                        class='bi bi-envelope-fill'></i>" . $tab["email"] . '</p>';

                ?>
                <?php
                if (isset($tab["fonction"]) && !empty($tab["fonction"])) { // on vérifie si l'utilisateur a saisie
                    echo "<p style='margin-left: 8px; margin-top:20px'><i style='margin-right: 30px;'
                        class='bi bi-briefcase-fill'></i>" . $tab["fonction"] . '</p>';
                }
                ?>
                <div class="d-grid gap-2">
                    <?php
                    echo " <a class='btn btn-primary' href='modifier_profil_admin.php?id=$idu' role='button'>Editer votre
                            profil</a>";
                    ?>
                    <a class="d-flex justify-content-center" style="text-decoration:
                        none;" href='../user/logout.php'>déconnexion</a>
                </div>

            </form>

        </div>
    </div>
</div>
</body>

</html>