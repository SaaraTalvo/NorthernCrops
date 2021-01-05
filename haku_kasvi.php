<?php

$html = '';

if(!empty($_POST)){

    $query = $_POST['query'];
    include 'database.php';
    $pdo = Database::connect();
    $pdo->exec('set names utf8');

    $sql = 'SELECT *
            FROM kasvi a
            WHERE nimi  LIKE "%' . $query . '%"';

    foreach ($pdo->query($sql) as $row) {
        $html .=  '
                    <tr>
                        <td>'. $row['nimi'] . '</td>
                        <td>'. $row['tieteellinen_nimi'] . '</td>
                        <td>'. $row['tyyppi'] . '</td>
                        <td>'. $row['kasvuaika'] . '</td>
                        <td>'. $row['korjuu'] . '</td>
                        <td>'. $row['kaytto'] . '</td>
                        <td>'. $row['kuva'] . '</td>
                    </tr>
                ';
    }

    Database::disconnect();

}

echo $html;