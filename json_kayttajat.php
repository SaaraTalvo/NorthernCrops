<?php

include 'database.php';
$query = '%';

if(isset($_POST['query'])){
    $query = $_POST['query'];
}

$pdo = Database::connect();
$pdo->exec('set names utf8');

$sql = 'SELECT nimi 
        FROM
        (SELECT CONCAT(etunimi, " ", sukunimi) nimi
        FROM kayttaja) a
        WHERE nimi LIKE "%' . $query . '%"';

$stmt = $pdo->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

echo json_encode($users);