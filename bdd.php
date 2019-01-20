<?php

$hostname = "localhost";
$passwd = "";
$user = "root";

try {
    $pdo = new PDO("mysql:dbname=test;host=$hostname",$user,$passwd);
} catch (PDOException $e) {
  echo "erreur de connexion = " . $e->getMessage();
}





 ?>
