<?php
require_once('../connexion.php');
$stm1 = $pdo->prepare("select * from admin WHERE email=?");
$stm1->execute(["ahrirb394@admin-web.com"]);
if ($stm1->rowCount() == 0) {
    $stm = $pdo->prepare("insert into admin  (nom,prenom,email,password) values(?,?,?,?)");
    $stm->execute([
        "badr",
        "ahrir",
        "ahrirb394@admin-web.com",
        password_hash(1234, PASSWORD_DEFAULT)
    ]);
}
/*********************************************************************************************/
if (isset($_POST["btn"])) {
    if ((!empty($_POST["NOM"]) && !empty($_POST["PRENOM"]) && !empty($_POST["EMAIL"]) && !empty($_POST["PASSWORD"]))) {
        if (filter_var($_POST["EMAIL"], FILTER_VALIDATE_EMAIL)) {
            if ($_POST["PASSWORD"] == $_POST["PASSWORD1"]) {
                require('../connexion.php');
                $stm1 = $pdo->prepare("select * from user WHERE email=?");
                $stm1->execute([$_POST["EMAIL"]]);
                if ($stm1->rowCount() == 0) {
                    $stm = $pdo->prepare("insert into user  (nom,prenom,email,password) values(?,?,?,?)");
                    $stm->execute([
                        $_POST['NOM'],
                        $_POST['PRENOM'],
                        $_POST['EMAIL'],
                        password_hash($_POST["PASSWORD"], PASSWORD_DEFAULT),
                    ]);
                    header("Location: login.php");
                    // close connexion
                } else {
                    header("Location: register.php?error=cet email déja existe dans la base de données!");
                }
            } else {
                header("Location: register.php?error=les deux mot de passe ne sont pas compatible");
            }
        } else {
            header("Location: register.php?error=l'adresse mail n'est pas valide");
        }
    } else {
        header("Location: register.php?error=Veuillez remplir les champs");
    }
}


?>
<!doctype html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>S'inscrire</title>
    <!-- bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- css file -->
    <link rel="stylesheet" href="style.css">
    <!-- boostrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>


<body>

    <div class="container">
        <div class="col-md-6 offset-md-3">
            <div class="well well-sm">
                <form method="post" action="register.php" class="mt-5 border p-4 bg-light shadow">

                    <h3>Inscription</h3>
                    <?php
                    if (isset($_GET['error'])) {
                        echo '<div class="alert alert-danger" role="alert">' . $_GET['error'] . "</div>";
                    }
                    ?>
                    <div class="form-row">
                        <div class="mb-3 col-md-12">
                            <div class="form-group">
                                <label>nom</label>
                                <input type="text" class="form-control" placeholder="nom" name="NOM">
                            </div>
                        </div>
                        <div class="mb-3 col-md-12">
                            <div class="form-group">
                                <label>prenom</label>
                                <input type="text" class="form-control" name="PRENOM" placeholder="prenom">
                            </div>
                        </div>
                        <div class="mb-3 col-md-12">
                            <div class="form-group">
                                <label>email</label>
                                <input type="email" class="form-control" placeholder="email" name="EMAIL">
                            </div>
                        </div>
                        <div class="mb-3 col-md-12">
                            <div class="form-group">
                                <label>mot de passe</label>
                                <input type="password" class="form-control" id="pass" placeholder="mot de passe"
                                    name="PASSWORD" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                            </div>
                        </div>
                        <div id="message">
                            <h6>votre mot de passe doit contenir:</h6>
                            <p id="letter" class="invalid">Une lettre minuscule</p>
                            <p id="capital" class="invalid">Une lettre majuscule </p>
                            <p id="number" class="invalid">Un numéro</p>
                            <p id="special_char" class="invalid">Caractères spéciaux</p>
                            <p id="length" class="invalid">8 caractères minimum</p>
                        </div>
                        <div class="mb-3 col-md-12">
                            <div class="form-group">
                                <label>confirmation mot de passe</label>
                                <input type="password" class="form-control" placeholder="confimrer votre mot de passe"
                                    name="PASSWORD1">
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" name="btn" type="submit">S'incrire</button>
                        </div>
                </form>
                <p class="text-center mt-3 ">Si vous avez un compte, veuillez<a href="login.php" style="text-decoration:
                        none;"> se connecter</a>
                </p>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="script.js"></script>
</body>

</html>