<?php
require_once ('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $equipe1 = $_POST['equipe1'];
    $equipe2 = $_POST['equipe2'];
    $score1 = $_POST['score1'];
    $score2 = $_POST['score2'];

    $sql = "INSERT INTO Equipe_Partie (id_equipe1, id_equipe2, score_equipe1, score_equipe2) 
            VALUES (?, ?, ?, ?)";
    $stmt = $mysqlClient->prepare($sql);

    $stmt->bind_param("iiii", $equipe1, $equipe2, $score1, $score2);

    if ($stmt->execute()) {
        echo "Les résultats ont été enregistrés avec succès !";
    } else {
        echo "Erreur lors de l'enregistrement des résultats : " . $stmt->error;
    }

    $stmt->close();
    $mysqlClient->close();
} else {
    echo "Méthode non autorisée.";
}
?>
