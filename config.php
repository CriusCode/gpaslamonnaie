<?php
$servername = "lancon.akoatic.ovh";
$username = "c13gpalamonnaie";
$password = "Jeanthomas2609!";
$dbname = "c13gpalamonnaie";

// Connexion à la base de données
try {
    $mysqlClient = new PDO(
        'mysql:host=' . $servername . ';dbname=' . $dbname . ';charset=utf8',
        $username,
        $password
    );    
} catch (Exception $e) {
    die("Échec de la connexion : " . $e);
}

?>