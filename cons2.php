<?php
$host = "localhost:3306";
$user = "root";
$password = "";
$database_name = "formialt";
$pdo = new PDO("mysql:host=$host;dbname=$database_name", $user, $password, array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
));
?>