<?php

if (isset($_GET["IDU"])) {
    require("../connexion.php");
    $stm = $pdo->prepare("select * from prod_excel where id_recherche=?");
    $stm->execute([$_GET["IDU"]]);
    $res = $stm->fetchAll(PDO::FETCH_ASSOC);
    if ($stm->rowCount() > 0) {
        $output = '<table border="1">
            <tr>
            <th>Id produit</th>
            <th>description du produit</th>
            <th>nouveau prix</th>
            <th>ancien prix</th>
            </tr>';
        foreach ($res as $s) {
            $output .= '<tr><td>' . $s["id_prod"] . '</td>
                <td>' . $s["desc_prod"] . '</td>
                <td>' . $s["nov_prix"] . '</td>
                <td>' . $s["anc_prix"] . '</td></tr>';
        }
        $output .= '</table>';
        header("Content-Type: application/xls");
        header("Content-Disposition: attachement; filename=download.xls");
        echo $output;
    }
}