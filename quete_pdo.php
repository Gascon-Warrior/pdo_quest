<?php

require_once 'connect.php';
$pdo = new PDO(DSN, USER, PASS);




$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll();
var_dump($friends);


$query = "INSERT INTO friend (firstname, lastname) VALUES ('Chandler', 'Bing')";
$statement = $pdo->exec($query);