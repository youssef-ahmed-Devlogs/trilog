<?php

$dsn   = "mysql:host=localhost;dbname=trilog";
$user  = "root";
$pass  = "";
$options = [
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
];

try {
    $conn = new PDO($dsn, $user, $pass, $options);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "<h2>Faield to connect to database</h2>" . $e->getMessage();
    die();
}
