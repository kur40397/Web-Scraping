<?php
require_once('../connexion.php');
if (isset($_POST["btn"])) {
    if ((!empty($_POST["EMAIL"]) && !empty($_POST["pwd"]))) {
        $arobase = explode("@", $_POST["EMAIL"]);
        $domaine = $arobase[1];
        if (strcmp($domaine, "admin-web.com") != 0) {
            $stm = $pdo->prepare("select * from user WHERE email=?");
            $stm->execute(array($_POST["EMAIL"]));
            if ($stm->rowCount() != 0) {
                $res = $stm->fetch(PDO::FETCH_ASSOC); // retourne une ligne indexé par le nom de la colonne
                if (password_verify($_POST["pwd"], $res["password"]) == true) {
                    if (isset($_POST["check"])) {
                        session_start();
                        $_SESSION["email"] = $res["email"];
                        $_SESSION["prenom"] = $res["prenom"];
                        $_SESSION["idu"] = $res["id"];
                        $idu = $res["id"];
                        header("Location:../home.php?id=$idu");
                    } else {
                        header("Location:../home.php");
                    }
                } else {
                    header("Location: login.php?error=email ou mot de passe incorrect !!");
                }
            } else {
                header("Location: login.php?error=email ou mot de passe incorrect !!");
            }
        } else {
            $stm = $pdo->prepare("select * from admin WHERE email=?");
            $stm->execute(array($_POST["EMAIL"]));
            if ($stm->rowCount() != 0) {
                $res = $stm->fetch(PDO::FETCH_ASSOC); // retourne une ligne indexé par le nom de la colonne
                if (password_verify($_POST["pwd"], $res["password"]) == true) {
                    header("Location:../home.php");
                    if (isset($_POST["check"])) {
                        session_start();
                        $_SESSION["EMAIL"] = $res["email"];
                        $_SESSION["PRENOM"] = $res["prenom"];
                        $_SESSION["IDA"] = $res["id"];
                        header("Location:../home.php?id=$idu");
                    } else {
                        header("Location:../home.php");
                    }
                } else {
                    header("Location: login.php?error=email ou mot de passe  de l'admin incorrect !!");
                }
            } else {
                header("Location: login.php?error=email ou mot de passe de l'admin incorrect !!");
            }
        }
    } else {
        header("Location: login.php?error=veuillez remplir votre champs!");
    }
}
?>
<!doctype html>

<body lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Connexion</title>
        <!-- bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
</body>
<div class="container">
    <div class="col-md-6 offset-md-3">
        <div class="well well-sm">
            <form method="post" action="login.php" class="mt-5 border p-4 bg-light shadow">
                <h3>Connexion</h3>
                <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_GET['error']; ?>
                </div>
                <?php } ?>
                <div class="row">
                    <div class="mb-3 col-md-12">
                        <div class="form-group">
                            <label>email</label>
                            <input type="email" class="form-control" id="exampleInputPassword1" placeholder="email"
                                name="EMAIL">
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <div class="form-group">
                            <label>mot de passe</label>
                            <input type="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Password" name="pwd">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="check">
                            <label class="form-check-label" for="exampleCheck1">Se souvenir de moi
                            </label>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" name="btn" type="submit">Connexion</button>
                    </div>
                </div>
                <p class="text-center mt-3">Si vous n'avez pas de compte, veuillez <a href="register.php" style="text-decoration:
                        none;">S'inscrire</a>
                </p>
                <p class="text-center mt-3"><a href="forget_password.php" style="text-decoration:
                        none;">Mot de passe oublié ?</a>
                </p>
            </form>

        </div>
    </div>
</div>
</body>

</html>