<?php
if (isset($_GET["IDU"])) {
    $d = $_GET["IDU"];
    require_once("../connexion.php");
    $stm = $pdo->prepare("select * 
    from user_recherche where id_recherche = ?");
    $stm->execute([$d]);
    $tab = $stm->fetch(PDO::FETCH_ASSOC);
    /************************************************************************/
    $idu = $tab["id_user"];
    $stm = $pdo->prepare("delete from recherches where id_recherche=?");
    $stm->execute([$d]);
    /************************************************************************/
    header("location:mes_recherches.php?id=$idu");
}