<?php
if (isset($_POST["btn"])) { // si l'utilisateur a cliquer sur un boutton
    if (!empty($_POST["pwd"]) && !empty($_POST["pwd1"])) { // si l'utilisateur a insérer les deux mot de passe
        $id = $_GET["id"];
        if ($_POST["pwd"] == $_POST["pwd1"]) { // si les deux mot de passe se ressemble
            require_once('../connexion.php'); // une connexion
            $stm = $pdo->prepare("update user set password = ? where id =? "); // modification du mot de passe
            $stm->execute(
                [
                    $_POST["pwd"],
                    $id
                ]
            );
            header("Location: changepwd.php?succ= votre mot de passe a été changé! veuillez <a href='login.php' class='alert-link'>se connecter</a>");
        } else {
            header("Location: changepwd.php?error= les deux mot de passe ne sont pas compatible! ");
        }
    } else {
        header("Location: changepwd.php?error= veuillez remplir votre ce formulaire");
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nouveau mot de passe</title>
    <!-- bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- css file -->
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <div class="container">
        <div class="col-md-6 offset-md-3">
            <div class="well well-sm">
                <form method="post" action="changepwd.php" class="mt-5 border p-4 bg-light shadow">
                    <h3>Nouveau mot de passe</h3>
                    <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-warning" role="alert">
                        <?php echo $_GET['error']  ?>
                    </div>
                    <?php } ?>
                    <?php if (isset($_GET['succ'])) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $_GET['succ']; ?>
                    </div>
                    <?php } ?>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <div class="form-group">
                                <label>le nouveau mot de passe:</label>
                                <input type="password" class="form-control" id="pass" name="pwd">
                            </div>
                        </div>
                        <div class="mb-3 col-md-12">
                            <div class="form-group">
                                <div id="message">
                                    <h6>votre mot de passe doit contenir:</h6>
                                    <p id="letter" class="invalid">Une lettre miniscule </p>
                                    <p id="capital" class="invalid">Une lettre majuscule</p>
                                    <p id="number" class="invalid">Un nombre</p>
                                    <p id="special_char" class="invalid">Un caractère spécial</p>
                                    <p id="length" class="invalid">Minimum 8 caractère </p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 col-md-12">
                            <div class="form-group">
                                <label>Confirmer le nouveau mot de passe:</label>
                                <input type="password" class="form-control" id="pass" name="pwd1">
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" name="btn" type="submit">Valider</button>
                        </div>
                    </div>
                    <p class="text-center mt-3"><a href="login.php" style="text-decoration:
                        none;">Annuler</a>
                    </p>

                </form>

            </div>
        </div>
    </div>


</body>

<script type="text/javascript" src="script.js"></script>


</html>