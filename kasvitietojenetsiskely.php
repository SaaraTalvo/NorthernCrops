<?php

$html = '';

if(!empty($_POST)){

    $query = $_POST['query'];
    include 'database.php';
    $pdo = Database::connect();
    $pdo->exec('set names utf8');

    $sql = 'SELECT *
            FROM
            (SELECT *, nimi 
            FROM kasvi) a
            WHERE nimi LIKE "%' . $query . '%"';

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

                        <td><a class="btn btn-light" href="katso_kasvi.php?id='.$row['kasviID'].'">Katso</a>
                        <a class="btn btn-secondary" href="paivita_kasvi.php?id='.$row['kasviID'].'">Päivitä</a>
                        <a class="btn btn-dark poista" data-content="Haluatko varmasti poistaa asiakkaan ' . $row['etunimi'] . ' ' . $row['sukunimi'] . ' tiedot?" href="poista_kasvi.php?id='.$row['kasviID'].'">Poista</a>
                        </td>
                
                    </tr>
                ';
    }

    Database::disconnect();

}

echo $html;