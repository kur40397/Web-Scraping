<?php
    if (isset($_GET["id"])) {
        $d = $_GET["id"];
        require_once("../connexion.php");
        $stm = $pdo->prepare("delete from user where id=?");
        $stm->execute([$d]);
        header("location:afficher_users.php");
    }