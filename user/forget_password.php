<?php
if (isset($_POST["btn"])) {
    if (!empty($_POST["EMAIL"])) {
        if (filter_var($_POST["EMAIL"], FILTER_VALIDATE_EMAIL)) {
            require_once('../connexion.php');
            $stm = $pdo->prepare("select * from user WHERE email=?"); // verifier si l'email existe 
            $stm->execute(array($_POST["EMAIL"]));
            if ($stm->rowCount() != 0) {
                $res = $stm->fetch(PDO::FETCH_ASSOC);
                $to = $_POST["EMAIL"];
                $subject = "Reinstallisation du mot de passe";
                $message = "<h1>Webscraping</h1>
            <p>Pour renouveller le mot de passe de compte utilisateur Webscraping.ma cliquez ce 
            <a href='http://localhost:3000/user/changepwd.php?id=$idu'>lien</a></p>";
                $headers = "Content-Type: text/html; charset=utf-8\r\n"; //le contenu du message envoyé
                $headers .= "From: WebScrap@gmail.com\r\n"; //l'expéditeur
                /*pour envoyer les messages:
            impossible d'envoiyer des messages mn serveurs local
            smtp : protocole  pour l'envoie des messages electronique
            1) configurer le fichier sendmail
            2) le nom du serveur smtp  de votre fournisseurs de massageries : smtp.gmail.com
            3) configurer le port aussi
            4)avoir un code d'application car =>Un mot de passe d'application est un code secret à 16 chiffres grâce auquel
             un appareil ou une application moins sécurisés peuvent accéder à votre compte Google.
            5) je pose mon adresse mail et le code de l'application 
            6) je configure php.ini
            7) poser le chemin de sendmail
            */
                if (mail($to, $subject, $message, $headers)) {
                    header("Location: forget_password.php?succ=le message a été envoyée avec succée!");
                } else {
                    header("Location: forget_password.php?error=le message n'a pas été envoyé!");
                }
            } else {
                header("Location: forget_password.php?error=email introuvable!");
            }
        } else {
            header("Location: forget_password.php?error=l'adresse mail n'est pas valide!");
        }
    } else {
        header("Location: forget_password.php?error=veuillez inserer l'email !");
    }
}
?>

<!doctype html>

<body lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Réinitialiser le mot de passe</title>
        <!-- bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
</body>
<div class="container">
    <div class="col-md-6 offset-md-3">
        <div class="well well-sm">
            <form method="post" action="forget_password.php" class="mt-5 border p-4 bg-light shadow">
                <h3>Réinitialiser le mot de passe</h3>
                <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_GET['error']; ?>
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
                            <label>email</label>
                            <input type="email" class="form-control" id="exampleInputPassword1" placeholder="email"
                                name="EMAIL">
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" name="btn" type="submit">Renvoyer l'e-mail</button>
                    </div>
                </div>
                <p class="text-center mt-3">retour à la page de<a href="login.php" style="text-decoration:
                        none;"> connexion </a>
                </p>
            </form>

        </div>
    </div>
</div>