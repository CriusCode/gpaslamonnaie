<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage du Classement</title>
</head>
<body>

<h2>Classement du Tournoi</h2>

<?php
include 'config.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$sql = "SELECT Equipe.nom_equipe, Equipe_Partie.score_equipe1, Equipe_Partie.score_equipe2
        FROM Equipe_Partie, Equipe
        WHERE Equipe_Partie.id_equipe1 = Equipe.id_equipe";
$result = $mysqlClient->query($sql);

if ($result) {
    echo '<table>
    <tr>
        <th>Équipe</th>
        <th>Score Équipe 1</th>
        <th>Score Équipe 2</th>
    </tr>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
        <td>' . $row["nom_equipe"] . '</td>
        <td>' . $row["score_equipe1"] . '</td>
        <td>' . $row["score_equipe2"] . '</td>
        </tr>';
    }
    echo '</table>';
} else {
    echo "Erreur dans la requête : " . $mysqlClient->error;
}

$mysqlClient->close();
?>
