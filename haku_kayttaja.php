<?php

$html = '';

if(!empty($_POST)){

    $query = $_POST['query'];
    include 'database.php';
    $pdo = Database::connect();
    $pdo->exec('set names utf8');

    $sql = 'SELECT *
            FROM
            (SELECT *, CONCAT(etunimi, " ", sukunimi) nimi
            FROM kayttaja) a
            WHERE nimi LIKE "%' . $query . '%"';

    foreach ($pdo->query($sql) as $row) {
        $html .=  '
                    <tr>
                        <td>'. $row['nimi'] . '</td>
                        <td>'. $row['sahkoposti'] . '</td>
                        <td>'. $row['postinumero'] . '</td>
                        <td>'. $row['postitoimipaikka'] . '</td>
                        <td>'. $row['kasvuvyohyke'] . '</td>

                        <td>
                        <a class="btn btn-secondary" href="paivita_kayttaja.php?id='.$row['kayttajaID'].'">Päivitä</a>
                        <a class="btn btn-dark poista" data-content="Haluatko varmasti poistaa asiakkaan ' . $row['etunimi'] . ' ' . $row['sukunimi'] . ' tiedot?" href="poista_kayttaja.php?id='.$row['kayttajaID'].'">Poista</a>
                        </td>
                    </tr>
                ';
    }

    Database::disconnect();

}

echo $html;