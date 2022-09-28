<?php
require("../connexion.php");
?>
<?php
if (isset($_GET["id"])) {
    $idu = $_GET["id"];
    $stm = $pdo->prepare("select * from admin where id=?");
    $stm->execute([$idu]);
    $tab = $stm->fetch(PDO::FETCH_ASSOC);
}
if (isset($_POST["BTN"])) { // on vérifie  sur l'utilisateur a cliqué sur un boutton 
    $idu = $_POST["ID"];
    if ((isset($_POST["IM"]) && $_POST["IM"] == 1)) { // si l'utilisateur a inseré une image
        $imagetype = ["jpg", "jpeg", "png", "gif"]; // tableau des abréviations des images
        $type = explode("/", $_FILES["image"]["type"]); // extraire le type de l'image
        if (in_array($type[1], $imagetype)) { // vérifier le type de l'image me correct 
            $tailleMax = 4 * 1024 * 1024; // la taille a respecter 4 MO 
            if ($_FILES["image"]["size"] < $tailleMax) { // vérifier si l'image insérer n'a pas dépasser
                $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
                $nom = "image_admin/" . uniqid("", true) . "." . $extension;
                move_uploaded_file($_FILES["image"]["tmp_name"], $nom);
            } else {
                header("Location: modifier_profil_admin.php?error=Vous avez dépassez les 4 Mo! & id=$idu");
                die();
            }
        } else {
            header("Location: modifier_profil_admin.php?error=Vous n'avez pas respectez le format de l'image ! & id=$idu");
            die();
        }
    } else {
        if (isset($_POST["IMA"])) {
            $nom = $_POST["IMA"];
        }
    }
    if (filter_var($_POST["EMAIL"], FILTER_VALIDATE_EMAIL)) {
        $stm = $pdo->prepare("update admin set nom = ? ,prenom = ? ,email = ? ,fonction = ?, image = ? where id = ?");
        $stm->execute([
            $_POST["NOM"],
            $_POST["PRENOM"],
            $_POST["EMAIL"],
            $_POST["FONCTION"],
            $nom,
            $idu
        ]);
        header("Location: modifier_profil_admin.php?id=$idu");
        die();
    } else {
        header("Location: modifier_profil_admin.php?error=l'adresse mail n'est pas valide !&id=$idu");
        die();
    }
}
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editer votre profil</title>
    <!-- bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- css file -->
    <link rel="stylesheet" href="style.css">
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

<body>
    <div class="container" style="position:absolute; left: -170px;">
        <div class="offset-md-5 ">
            <form method="post" action="modifier_profil_admin.php" class="mt-5 border p-4 bg-light shadow"
                enctype="multipart/form-data">
                <h3>Editer votre profil</h3>
                <?php
                if (isset($tab['image'])) {
                    echo "<img src=" . $tab['image'] . " class=avatar alt='image de l'administrateur'>";
                } else {
                    echo "<img src='../user/image/avatar.png' class=avatar alt='image de l'administrateur'>";
                }
                ?>
                <?php
                if (!empty($_GET['error'])) {
                    echo '<div class="alert alert-danger" role="alert">' . $_GET['error'] . "</div>";
                }
                ?>
                <div class="form-row">
                    <div class="mb-3 col-md-12 ">
                        <div class="form-group">
                            <label>nom</label>
                            <input class="form-control" type="text" placeholder="nom" name="NOM"
                                value="<?php echo $tab["nom"]; ?>">
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <div class="form-group">
                            <label>prenom</label>
                            <input type="text" class="form-control" name="PRENOM" placeholder="prenom"
                                value="<?php echo $tab["prenom"]; ?>">
                        </div>
                    </div>
                </div>
                <div class="mb-3 col-md-12">
                    <div class="form-group">
                        <label>email</label>
                        <input type="email" class="form-control" placeholder="email" name="EMAIL"
                            value="<?php echo $tab["email"]; ?>">
                    </div>
                </div>
                <div class="mb-3 col-md-12">
                    <div class="form-group">
                        <label>Fonction</label>
                        <input type="text" class="form-control" placeholder="Fonction" name="FONCTION"
                            value="<?php echo $tab["fonction"]; ?>" onfocus="this.value=''">
                    </div>
                </div>
                <div class="mb-3 col-md-12">
                    <div class="form-group">
                        <div class="mb-3">
                            <label class="form-label" for="customFile">inserer une image</label>
                            <input type="hidden" name="IMA" value="<?php echo $tab["image"] ?>" />
                            <input type="file" name="image" class="form-control" id="file" />
                            <input type="hidden" id="hifile" name="IM">
                        </div>
                    </div>
                </div>
                <script>
                document.querySelector("#file").addEventListener("input", test);

                function test(e) {
                    document.getElementById("hifile").value = 1;
                }
                </script>
                <input type="hidden" name="ID" value="<?php echo $_GET["id"]; ?>">
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" name="BTN" type="submit">Sauvegarder la
                        modification</button>
                </div>
                <?php
                echo "<p class='text-center mt-3'>Pour voir votre<a  style='text-decoration:
                none;' href='voir_profil_admin.php?id=$idu'> profil</a>"
                ?>
            </form>
            </p>
        </div>
    </div>
    <script type="text/javascript" src="script.js"></script>

</body>


</html>